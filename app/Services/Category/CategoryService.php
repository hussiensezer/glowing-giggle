<?php


namespace App\Services\Category;


use App\Models\Category;
use App\Traits\FormatResponseTrait;
use App\Traits\MediaTrait;
use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;


class CategoryService
{
    use MediaTrait, FormatResponseTrait;
    public function data(string $type, $request) :object
    {
        $paginate = $request->has('limit') ? $request->limit : config('setting.LimitPaginate');
        return Category::type($type)
        ->parent()
        ->withCount('childCategories')
        ->with([
            'childCategories' => function($query) {
                $query->withCount('childCategories');
            },
            'childCategories.childCategories',
        ])
        ->latest()
        ->paginate($paginate)
        ->withQueryString();
    }// End Category With Full nested Of SubCategories

    public function categoriesWithSub(string $type) :object
    {
        return Category::parent()
            ->type($type)
            ->with('childCategories')->latest()->get();

    }// End Categories With Level One Of Nested SubCategories


    Public function storeCategory($type,object $request)
    {
        $category  = Category::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'slug'          => Str::slug($request->slug),
            'status'        => $request->status,
            'parent_id'     => $this->parentId($request),
            'level'         => $this->categoryLevel($request),
            'category_type' => $type,
        ]);

        $this->storeCategoryImage($category,$request);

    }// End StoreCategory

    public function updateCategory(object $request, $category)
    {
        $category->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'slug'          => Str::slug($request->slug),
            'status'        => $request->status,
            'parent_id'     => $this->parentId($request),
            'level'         => $this->categoryLevel($request),
        ]);

        // Check If User Want Change Image Not Keep it
        if ($request->hasFile('image')) {
            // Remove The Old One
            $this->deleteMedia('files', 'categories/' . $request->category_type, $category->image);
            // Then Replace By New Image
           $this->storeCategoryImage($category,$request);
        }
    }// End Update Category


    private function parentId($request)
    {
        if($request->filled('parent_id')) {
            $categoryId = $request->parent_id;
            $category = end($categoryId);
        }else {
            $category = $request->parent_id;
        }

        return $category;
    }// End ParentId


    private function categoryLevel($request): int
    {
        $categoryLevel= $request->filled('parent_id') ? $request->parent_id :  [] ;

        return count($categoryLevel) + 1;
    }// End CategoryLevel

    private function storeCategoryImage($category,$request)
    {
        $category->update([
            'image' => $this->storeMedia($request->image, 'files', 'categories/' . $request->category_type),
        ]);
    }// End StoreCategoryImage

    public function filter(string $type,$request)
    {

        //Paginate
        $paginate = $request->has('limit') ? $request->limit : config('setting.LimitPaginate');
        $categories =  Category::query();
        // Start Search
        $query =  $this->search($categories,$request);
        //End Search
        return $categories->type($type)

            ->latest()
            ->paginate($paginate)
            ->withQueryString();
    }// End Filter

    public function categories(string $type)
    {
        return Category::select(['id','name'])->parent()->type($type)->get();

    }// End Categories

    public function subCategories(string $type,$category )
    {
        return Category::select(['id','name'])
            ->type($type)
            ->where('parent_id', $category)
            ->get();

    }// End SubCategories

    public function search($model , $request)
    {
        //Search
        $query =  $model->when($request->name,function($q) use($request){
            $q->where('name', 'like', '%' . $request->name. '%');
            $q->orWhere('description','like', '%' . $request->name. '%' );
            $q->orWhere('slug','like', '%' . $request->name. '%' );
        });

        $query = $model->when($request->level,function($q) use($request){
            $q->whereIn('level', array_values($request->level));
        });

        $query= $model->when($request->start_date ,function ($q) use($request) {
            $start_date = Carbon::parse($request->start_date)
                ->toDateTimeString();

            $end_date = Carbon::parse($request->end_date)
                ->toDateTimeString();
            $q->whereBetween('created_at', [$start_date, $end_date]);
        });
    }

}
