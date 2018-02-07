<form action="{{url('/reserve')}}" method="POST">
    <div class="form-group">
        <label>Choose a Table</label>
        <select name="_table" id="select" class="form-control">
           
        </select>
        <input type="hidden" name="__from" id="__from">
        <input name="__to" id="__to" type="hidden">
        {{csrf_field()}}
    </div>
    <div class="form-group">
        <label>Name <span class="text-red">*</span></label>
        <input type="text" required min="3" name="_name" class="form-control">
    </div>
    <div class="form-group">
        <label>Mobile Phone<span class="text-red">*</span></label>
        <input type="text" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" title="not a valid phone number.It should be like 0312-1234567" name="_phone" class="form-control">
    </div>
    <div class="form-group">
        <label>Email <span class="text-red">*</span></label>
        <input type="email" name="_email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Let us know if you want something special (optional)</label>
        <textarea id="" rows="4" name="_comment" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Book</button>
</form>