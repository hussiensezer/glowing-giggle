@props(['categories'])


@foreach($categories as $i => $category)
    <!-- Parent-->
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->created_at}}</td>
        <td title="{{$category->description}}">{{str_limit($category->description, 10)}}</td>
        <td>{{$category->level}}</td>
        <td>{{$category->child_categories_count}}</td>
        <td>
            <x-dashboard.status status="{{$category->status}}"></x-dashboard.status>
        </td>

        <td>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{route('dashboard.categories.item.edit', $category->id)}}" class="edit fs-5">
                    <ion-icon name="create-outline"></ion-icon>
                </a>

            </div>
        </td>
    </tr>
{{--    @if($category->childCategories)--}}
{{--    <!-- End Parent-->--}}
{{--    @foreach($category->childCategories as $i => $child)--}}
{{--        <!-- Child-->--}}
{{--        <tr>--}}
{{--            <td> -{{$child->id}}</td>--}}
{{--            <td>{{$child->name}}</td>--}}
{{--            <td>{{$child->created_at}}</td>--}}
{{--            <td title="{{$child->description}}">{{str_limit($child->description, 10)}}</td>--}}
{{--            <td>{{$child->level}}</td>--}}
{{--            <td>{{$child->child_categories_count}}</td>--}}
{{--            <td>--}}
{{--               <x-dashboard.status status="{{$child->status}}"></x-dashboard.status>--}}
{{--            </td>--}}

{{--            <td>--}}
{{--                <div class="d-flex justify-content-between align-items-center">--}}
{{--                    <a href="{{route('dashboard.categories.item.edit', $child->id)}}" class="edit fs-5">--}}
{{--                        <ion-icon name="create-outline"></ion-icon>--}}
{{--                    </a>--}}

{{--                </div>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <!-- End Child-->--}}

{{--        <!-- Start Child Child-->--}}
{{--        @foreach($child->childCategories as $i => $childChild)--}}
{{--            <!-- Child-->--}}
{{--            <tr>--}}
{{--                <td> --{{$childChild->id}}</td>--}}
{{--                <td>{{$childChild->name}}</td>--}}
{{--                <td>{{$childChild->created_at}}</td>--}}
{{--                <td title="{{$childChild->description}}">{{str_limit($childChild->description, 10)}}</td>--}}
{{--                <td>{{$childChild->level}}</td>--}}
{{--                <td>{{$childChild->child_categories_count}}</td>--}}
{{--                <td>--}}
{{--                    <x-dashboard.status status="{{$childChild->status}}"></x-dashboard.status>--}}
{{--                </td>--}}

{{--                <td>--}}
{{--                    <div class="d-flex justify-content-between align-items-center">--}}
{{--                        <a href="{{route('dashboard.categories.item.edit', $childChild->id)}}" class="edit fs-5">--}}
{{--                            <ion-icon name="create-outline"></ion-icon>--}}
{{--                        </a>--}}

{{--                    </div>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            <!-- End Child-->--}}
{{--        @endforeach--}}
{{--        <!-- End Child Child-->--}}
{{--    @endforeach--}}
{{--    @endif;--}}

@endforeach

