<div class="row">
    <div class="col-lg-12">
        <h2> Criação de nova tarefa</h2>
    </div>
</div>

<?php echo form_open_multipart("clientrest/addMovieValidation", 'role="form" class="form-horizontal"')?>

    <div class="row">
        <div class="col-lg-12">
            <?php echo validation_errors(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group row">
                <?php echo form_label('Title', 'inputTitle', array('class' => 'col-lg-3 control-label'))?>
                <div class="col-lg-9">
                    <?php echo form_input('inputTitle', set_value('inputTitle'), 'class="form-control"')?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group row">
                <?php echo form_label('Year', 'inputYear', array('class' => 'col-lg-3 control-label'))?>
                <div class="col-lg-9">
                    <?php echo form_input('inputYear', set_value('inputYear'), 'class="form-control"')?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group row">
                <?php echo form_label('Description', 'inputDescription', array('class' => 'col-lg-3 control-label'))?>
                <div class="col-lg-9">
                    <?php echo form_input('inputDescription', set_value('inputDescription'), 'class="form-control"')?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <?php echo form_label('IMDB', 'inputImdb_id', array('class' => 'col-lg-3 control-label'))?>
                <div class="col-lg-9">
                    <?php echo form_input('inputImdb_id', set_value('inputImdb_id'), 'class="form-control"')?>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group row">
                <?php echo form_label('Gender', 'inputGender', array('class' => 'col-lg-3 control-label'))?>
                <div class="col-lg-9">
                    <?php echo form_input('inputGender', set_value('inputGender'), 'class="form-control"')?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <?php $name="userfile"; ?>
                <?php echo form_label('Anexo', $name , array('class' => 'col-lg-3 control-label'))?>
                <div class="col-lg-9">
                    <?php echo form_upload($name, set_value($name), 'class="form-control" id = "'. $name .'" placeholder="Anexo')?>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <p class="text-center">
                <br>
                <button type="submit" class="btn btn-primary"> Criar Filme</button>
            </p>
        </div>
    </div>
<?php echo form_close()?>

