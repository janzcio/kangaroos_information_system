<form class="form-material" id="{{$formId}}" data-href="{{ $isEdit ? route('api.put.kangaroos.update', $kangaroo->id) : route('api.post.kangaroos.store') }}">
    {{ csrf_field() }}
    @if($isEdit)
        {{method_field('PUT')}}
    @endif
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Upload File</label>
        <div class="col-sm-4">
            <input accept="image/*" type='file' name="photo" id="imgInp" />
        </div>
        <div class="col-sm-6">
            @if($isEdit && file_exists(storage_path('app/public/uploads/'.$kangaroo->id.'.jpg')))
                <img id="imgPreview" src="{{ $isEdit ? asset('storage/uploads/'.$kangaroo->id.'.jpg') : '' }}" alt="your image" width="100"/>
            @else
                <img id="imgPreview" src="{{ asset('images/placeholders/jk-placeholder-image.jpg') }}" alt="your image" width="100"/>
            @endif
            
        </div>
    </div>
    <div class="form-group form-default">
        <input type="text" name="name" id="name" class="form-control fill" value="{{ $isEdit ? $kangaroo->name : '' }}" required>
        <span class="form-bar"></span>
        <label class="float-label">Name</label>
    </div>
    <div class="form-group form-default">
        <input type="text" name="nickname" id="nickname" class="form-control fill" value="{{ $isEdit ? $kangaroo->nickname : '' }}">
        <span class="form-bar"></span>
        <label class="float-label">Nickname</label>
    </div>
    <div class="form-group form-default">
        <input type="text" name="weight" id="weight" class="form-control fill" value="{{ $isEdit ? $kangaroo->weight : '' }}">
        <span class="form-bar"></span>
        <label class="float-label">Weight</label>
    </div>
    <div class="form-group form-default">
        <input type="text" name="height" id="height" class="form-control fill" value="{{ $isEdit ? $kangaroo->height : '' }}">
        <span class="form-bar"></span>
        <label class="float-label">Height</label>
    </div>
    <div class="form-group form-default">
        <select name="gender" id="gender" class="form-control fill">
            <option value="Male" {{ $isEdit ? (strtolower($kangaroo->gender) == 'male' ? 'selected' : '') : '' }}>Male</option>
            <option value="Female" {{ $isEdit ? (strtolower($kangaroo->gender) == 'female' ? 'selected' : '') : '' }}>Female</option>
        </select>
        <span class="form-bar"></span>
        <label class="float-label">Gender</label>
    </div>
    <div class="form-group form-default">
        <input type="text" name="color" id="color" class="form-control fill" value="{{ $isEdit ? $kangaroo->color : '' }}">
        <span class="form-bar"></span>
        <label class="float-label">Color</label>
    </div>
    <div class="form-group form-default">
        <select name="friendliness" id="friendliness" class="form-control fill">
            <option value=""></option>
            <option value="friendly" {{ $isEdit ? (strtolower($kangaroo->friendliness) == 'friendly' ? 'selected' : '') : '' }}>Friendly</option>
            <option value="not friendly" {{ $isEdit ? (strtolower($kangaroo->friendliness) == 'not friendly' ? 'selected' : '') : '' }}>Not friendly</option>
        </select>
        <span class="form-bar"></span>
        <label class="float-label">Friendliness</label>
    </div>
    <div class="form-group form-default">
        <input type="date" name="birthday" class="form-control fill" value="{{ $isEdit ? $kangaroo->birthday : '' }}">
        <span class="form-bar"></span>
        <label class="float-label">Birthday</label>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">{{ $submitButton }}</button>
    </div>
</form>