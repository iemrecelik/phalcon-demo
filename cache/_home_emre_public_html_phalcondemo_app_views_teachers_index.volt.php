<div class="row">
    <div class="col-sm-12 page-header">
        <h1>
            Search teachers
        </h1>
        <p>
            <?= $this->tag->linkTo(['teachers/new', 'Create teachers']) ?>
        </p>
    </div>
    
    <?= $this->getContent() ?>

    <div class="col-sm-12">
        <?= $this->tag->form(['teachers/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

        <div class="form-group">
            <label for="fieldName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <?= $this->tag->textField(['name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldName']) ?>
            </div>
        </div>
        
        <div class="form-group">
            <label for="fieldSurname" class="col-sm-2 control-label">Surname</label>
            <div class="col-sm-10">
                <?= $this->tag->textField(['surname', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldSurname']) ?>
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-default']) ?>
            </div>
        </div>
        
        </form>
    </div>
</div>

