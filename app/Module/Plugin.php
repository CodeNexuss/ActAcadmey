<?php

// Initialize the filter globals.
require( dirname( __FILE__ ) . '/UdifyHook.php' );

/** @var udifyHook[] $udify_filter */
global $udify_filter, $udify_actions, $udify_current_filter;

if ( $udify_filter ) {
	$udify_filter = udifyHook::build_preinitialized_hooks( $udify_filter );
} else {
	$udify_filter = array();
}

if ( ! isset( $udify_actions ) ) {
	$udify_actions = array();
}

if ( ! isset( $udify_current_filter ) ) {
	$udify_current_filter = array();
}

/**
 * @param $tag
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 * @return bool
 */
function add_filter( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
	global $udify_filter;
	if ( ! isset( $udify_filter[ $tag ] ) ) {
		$udify_filter[ $tag ] = new udifyHook();
	}
	$udify_filter[ $tag ]->add_filter( $tag, $function_to_add, $priority, $accepted_args );
	return true;
}

/**
 * @param $tag
 * @param bool $function_to_check
 * @return bool|int
 */
function has_filter( $tag, $function_to_check = false ) {
	global $udify_filter;

	if ( ! isset( $udify_filter[ $tag ] ) ) {
		return false;
	}

	return $udify_filter[ $tag ]->has_filter( $tag, $function_to_check );
}

/**
 * @param $tag
 * @param $value
 * @return mixed
 */
function apply_filters( $tag, $value ) {
	global $udify_filter, $udify_current_filter;

	$args = func_get_args();

	// Do 'all' actions first.
	if ( isset( $udify_filter['all'] ) ) {
		$udify_current_filter[] = $tag;
		_udify_call_all_hook( $args );
	}

	if ( ! isset( $udify_filter[ $tag ] ) ) {
		if ( isset( $udify_filter['all'] ) ) {
			array_pop( $udify_current_filter );
		}
		return $value;
	}

	if ( ! isset( $udify_filter['all'] ) ) {
		$udify_current_filter[] = $tag;
	}

	// Don't pass the tag name to udifyHook.
	array_shift( $args );

	$filtered = $udify_filter[ $tag ]->apply_filters( $value, $args );

	array_pop( $udify_current_filter );

	return $filtered;
}

/**
 * @param $tag
 * @param $args
 * @return mixed
 */
function apply_filters_ref_array( $tag, $args ) {
	global $udify_filter, $udify_current_filter;

	// Do 'all' actions first
	if ( isset( $udify_filter['all'] ) ) {
		$udify_current_filter[] = $tag;
		$all_args            = func_get_args();
		_udify_call_all_hook( $all_args );
	}

	if ( ! isset( $udify_filter[ $tag ] ) ) {
		if ( isset( $udify_filter['all'] ) ) {
			array_pop( $udify_current_filter );
		}
		return $args[0];
	}

	if ( ! isset( $udify_filter['all'] ) ) {
		$udify_current_filter[] = $tag;
	}

	$filtered = $udify_filter[ $tag ]->apply_filters( $args[0], $args );

	array_pop( $udify_current_filter );

	return $filtered;
}

/**
 * @param $tag
 * @param $function_to_remove
 * @param int $priority
 * @return bool
 */
function remove_filter( $tag, $function_to_remove, $priority = 10 ) {
	global $udify_filter;

	$r = false;
	if ( isset( $udify_filter[ $tag ] ) ) {
		$r = $udify_filter[ $tag ]->remove_filter( $tag, $function_to_remove, $priority );
		if ( ! $udify_filter[ $tag ]->callbacks ) {
			unset( $udify_filter[ $tag ] );
		}
	}

	return $r;
}

/**
 * @param $tag
 * @param bool $priority
 * @return bool
 */
function remove_all_filters( $tag, $priority = false ) {
	global $udify_filter;

	if ( isset( $udify_filter[ $tag ] ) ) {
		$udify_filter[ $tag ]->remove_all_filters( $priority );
		if ( ! $udify_filter[ $tag ]->has_filters() ) {
			unset( $udify_filter[ $tag ] );
		}
	}

	return true;
}

/**
 * @return mixed
 */
function current_filter() {
	global $udify_current_filter;
	return end( $udify_current_filter );
}

/**
 * @return string
 */
function current_action() {
	return current_filter();
}

/**
 * @param null $filter
 * @return bool
 */
function doing_filter( $filter = null ) {
	global $udify_current_filter;

	if ( null === $filter ) {
		return ! empty( $udify_current_filter );
	}

	return in_array( $filter, $udify_current_filter );
}

/**
 * @param null $action
 * @return bool
 */
function doing_action( $action = null ) {
	return doing_filter( $action );
}

/**
 * @param $tag
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 * @return true
 */
function add_action( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
	return add_filter( $tag, $function_to_add, $priority, $accepted_args );
}

/**
 * @param $tag
 * @param mixed ...$arg
 */
function do_action( $tag, ...$arg ) {
	global $udify_filter, $udify_actions, $udify_current_filter;

	if ( ! isset( $udify_actions[ $tag ] ) ) {
		$udify_actions[ $tag ] = 1;
	} else {
		++$udify_actions[ $tag ];
	}

	// Do 'all' actions first
	if ( isset( $udify_filter['all'] ) ) {
		$udify_current_filter[] = $tag;
		$all_args            = func_get_args();
		_udify_call_all_hook( $all_args );
	}

	if ( ! isset( $udify_filter[ $tag ] ) ) {
		if ( isset( $udify_filter['all'] ) ) {
			array_pop( $udify_current_filter );
		}
		return;
	}

	if ( ! isset( $udify_filter['all'] ) ) {
		$udify_current_filter[] = $tag;
	}

	if ( empty( $arg ) ) {
		$arg[] = '';
	} elseif ( is_array( $arg[0] ) && 1 === count( $arg[0] ) && isset( $arg[0][0] ) && is_object( $arg[0][0] ) ) {
		// Backward compatibility for PHP4-style passing of `array( &$this )` as action `$arg`.
		$arg[0] = $arg[0][0];
	}

	$udify_filter[ $tag ]->do_action( $arg );

	array_pop( $udify_current_filter );
}

/**
 * @param $tag
 * @return int
 */
function did_action( $tag ) {
	global $udify_actions;

	if ( ! isset( $udify_actions[ $tag ] ) ) {
		return 0;
	}

	return $udify_actions[ $tag ];
}

/**
 * @param $tag
 * @param $args
 */
function do_action_ref_array( $tag, $args ) {
	global $udify_filter, $udify_actions, $udify_current_filter;

	if ( ! isset( $udify_actions[ $tag ] ) ) {
		$udify_actions[ $tag ] = 1;
	} else {
		++$udify_actions[ $tag ];
	}

	// Do 'all' actions first
	if ( isset( $udify_filter['all'] ) ) {
		$udify_current_filter[] = $tag;
		$all_args            = func_get_args();
		_udify_call_all_hook( $all_args );
	}

	if ( ! isset( $udify_filter[ $tag ] ) ) {
		if ( isset( $udify_filter['all'] ) ) {
			array_pop( $udify_current_filter );
		}
		return;
	}

	if ( ! isset( $udify_filter['all'] ) ) {
		$udify_current_filter[] = $tag;
	}

	$udify_filter[ $tag ]->do_action( $args );

	array_pop( $udify_current_filter );
}

/**
 * @param $tag
 * @param bool $function_to_check
 * @return false|int
 */
function has_action( $tag, $function_to_check = false ) {
	return has_filter( $tag, $function_to_check );
}

/**
 * @param $tag
 * @param $function_to_remove
 * @param int $priority
 * @return bool
 */
function remove_action( $tag, $function_to_remove, $priority = 10 ) {
	return remove_filter( $tag, $function_to_remove, $priority );
}

/**
 * @param $tag
 * @param bool $priority
 * @return true
 */
function remove_all_actions( $tag, $priority = false ) {
	return remove_all_filters( $tag, $priority );
}

/**
 * @param $args
 */
function _udify_call_all_hook( $args ) {
	global $udify_filter;

	$udify_filter['all']->do_all_hook( $args );
}

function _udify_filter_build_unique_id( $tag, $function, $priority ) {
	global $udify_filter;
	static $filter_id_count = 0;

	if ( is_string( $function ) ) {
		return $function;
	}

	if ( is_object( $function ) ) {
		// Closures are currently implemented as objects
		$function = array( $function, '' );
	} else {
		$function = (array) $function;
	}

	if ( is_object( $function[0] ) ) {
		// Object Class Calling
		return spl_object_hash( $function[0] ) . $function[1];
	} elseif ( is_string( $function[0] ) ) {
		// Static Calling
		return $function[0] . '::' . $function[1];
	}
}
