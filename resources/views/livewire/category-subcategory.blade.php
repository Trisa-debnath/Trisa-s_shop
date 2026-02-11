<div>
    <label for="category_id" class="mb-2"  style="font-weight: bold; color: black;">Category Name</label>
   <select class="form-control" name="category_id" wire:model.live = "selectedCategory" required>
    <option value=""> Select A Category </option>
    @foreach($categories as $category)
    <option value="{{$category->id}}">{{$category->category_name}}</option>
    @endforeach
   </select>

  
<label for="subcategory_id" class="mb-2" style="font-weight: bold; color: black;">SubCategory Name</label>
    <select class="form-control" name="subcategory_id" required >
    <option value=""> Select A SubCategory </option>
    @foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
    @endforeach
   </select>
</div>
