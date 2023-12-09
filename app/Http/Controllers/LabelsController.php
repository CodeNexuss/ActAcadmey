<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Labels;

class LabelsController extends Controller
{
    //

    public function manage_labels(Request $request) {
        $data['title'] = 'Manage Labels';
        $data['labels'] = Labels::take(10)->orderBy('id', 'desc')->paginate();
        return view('admin.labels.manage_labels', $data);
    }

    public function create(Request $request) {
        $data['title'] = 'Add Labels';
        if($request->isMethod('GET')) {
            return view('admin.labels.add_labels', $data);
        } else {
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));

            $rules = [
                'order'                         => 'unique:labels,order'
            ];
            $this->validate($request, $rules);

            $label = new Labels;
            $label->label_name                  = $request->label_name;
            $label->label_color                 = $request->label_color;
            $label->number_of_sales             = $request->number_of_sales;
            $label->min_avg_ratings             = $request->min_avg_ratings;
            $label->number_of_recent_days       = $request->number_of_recent_days;
            $label->min_ratings_count           = $request->min_ratings_count;
            $label->number_of_days_from_arrived = $request->number_of_days_from_arrived;
            $label->order                       = $request->order;
            $label->save();

            return redirect(route('manage_labels'))->with('success', 'Label has been created');
        }
    }

    public function edit(Request $request, $id) {
        $data['title'] = 'Edit Labels';
        $label = Labels::findOrFail($id);
        $data['label'] = $label;
        if($request->isMethod('GET')) {
            return view('admin.labels.edit_labels', $data);
        } else {
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));

            $rules = [
                'order' => 'unique:labels,order,'.$id
            ];
            $this->validate($request, $rules);

            $label->label_name                  = $request->label_name;
            $label->label_color                 = $request->label_color;
            $label->number_of_sales             = $request->number_of_sales;
            $label->min_avg_ratings             = $request->min_avg_ratings;
            $label->number_of_recent_days       = $request->number_of_recent_days;
            $label->min_ratings_count           = $request->min_ratings_count;
            $label->number_of_days_from_arrived = $request->number_of_days_from_arrived;
            $label->order                       = $request->order;
            $label->save();

            return redirect(route('manage_labels'))->with('success', 'Label has been updated');
        }
    }

    public function delete(Request $request, $id) {
        if(is_live_env()) return back()->with('error', __a('demo_restriction'));

        Labels::where('id', $id)->delete();
        return redirect(route('manage_labels'))->with('success', 'Label has been deleted');
    }

}
