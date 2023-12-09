@if($section->items->count())
    @foreach($section->items as $item)

        <div id="section-item-{{$item->id}}" class="edit-curriculum-item mb-2 edit-curriculum-{{$item->item_type}}">

            <div class="section-item-top align-items-center border p-3 d-flex bg-white">
                <div class="section-item-title">
                    {!! $item->icon_html !!}
                    <span class="section-item-title-text">{{$item->title}}</span>
                </div>

                <button class="section-item-btn-tool btn px-1 py-0 section-item-edit-btn" data-item-id="{{$item->id}}" ><i class="la la-pencil"></i> </button>
                <button class="section-item-btn-tool text-danger btn px-0 py-0 section-item-delete-btn" data-item-id="{{$item->id}}" ><i class="la la-trash"></i> </button>

                <p class="section-item-btn-tool m-0 btn ml-2 px-1 py-0 section-item-sorting-bar ml-auto" ><i class="la la-bars"></i> </p>
            </div>

            <div class="section-item-edit-form-wrap"></div>

        </div>
    @endforeach

@else
    <p class="m-0 text-muted">{{__t('section_empty_text')}}</p>
@endif
