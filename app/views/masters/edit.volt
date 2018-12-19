<div class="row">

    <div class="col-sm-12">
        <nav>
            <ul class="pager">
                <li class="previous">{{ link_to("masters", "Go Back") }}</li>
                <li class="previous">{{ link_to("masters/list", "List") }}</li>
            </ul>
        </nav>
    </div>
    
    <div class="col-sm-12 page-header">
        <h1>
            Edit masters
        </h1>
    </div>

    <div class="col-sm-12 msgs"></div>
    
    {{ content() }}
    <div class="col-sm-12">
        {{ form("masters/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal", 'onsubmit': 'update(this);return false;') }}

        <div class="form-group">
            <label for="fieldName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                {{ text_field("name", "size" : 30, "class" : "form-control", "id" : "fieldName") }}
            </div>
        </div>
        
        <div class="form-group">
            <label for="fieldSurname" class="col-sm-2 control-label">Surname</label>
            <div class="col-sm-10">
                {{ text_field("surname", "size" : 30, "class" : "form-control", "id" : "fieldSurname") }}
            </div>
        </div>
        
        
        {{ hidden_field("id") }}
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ submit_button('Send', 'class': 'btn btn-default') }}
            </div>
        </div>
        
        </form>
    </div>
</div>
