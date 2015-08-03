<div id="medical_history" class="box-body no-margin">
    <div class="skubbs_result">
        <form action="#" method="post" id="data_medical_history">
            <ul class="products-list product-list-in-box margin">
                <li class="item" id="message">
                    <?php if (isset($medical_history['var']['message'])): ?>
                        <div class="alert alert-<?php echo $medical_history['var']['message_type'] ?>"><?php echo $medical_history['var']['message'] ?></div>
                    <?php endif ?>
                </li>
                <li class="item">
                    <div class="btn-group pull-right">
                        <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="#" class="btn btn-primary skubbs_btn-save" style="display:none">Save</a>
                        <a href="#" class="btn btn-default skubbs_btn-cancel" style="display:none">Cancel</a>
                    </div>
                </li>
                <li class="item">
                    <strong>Blood Type: </strong>
                    <span class="skubbs_output" id="blood_type"><?php echo $medical_history['data']->blood_type ?></span>
                    <?php echo form_dropdown('blood_type', $medical_history['var']['blood_type'], $medical_history['data']->blood_type, 'id="blood_type" class="skubbs_input"'); ?>
                </li>
                <li class="item">
                    <strong>Immunizations: </strong>
                    <div>
                        <span class="skubbs_output" id="immunization"><?php echo $medical_history['data']->immunization ?></span>
                        <textarea name="immunization" id="immunization" class="form-control skubbs_input" rows="3"><?php echo $medical_history['data']->immunization ?></textarea>
                    </div>
                </li>
                <li class="item">
                    <strong>Past Hospitalizations and Surgeries: </strong>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="label-primary col-md-4">Date/Year</th>
                                    <th class="label-primary col-md-8">Details</th>
                                </tr>
                            </thead>
                            <tbody id="phas">
                                <?php foreach ($medical_history['data']->phas as $phas): ?>
                                <tr class="skubbs_output">
                                    <td><?php echo $phas[0] ?></td>
                                    <td><?php echo $phas[1] ?></td>
                                </tr>
                                <?php endforeach ?>
                                <?php foreach ($medical_history['data']->phas as $phas): ?>
                                <tr class="skubbs_input">
                                    <td><input type="text" name="phas_date_year[]" value="<?php echo $phas[0] ?>" class="form-control"></td>
                                    <td>
                                        <div class="input-group" style="margin-bottom: 5px">
                                            <input type="text" class="form-control" name="phas_detail[]" value="<?php echo $phas[1] ?>">
                                            <a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr class="skubbs_input">
                                    <td colspan="2">
                                        <a href="#" class="btn btn-info btn-xs skubbs_btn-add" s-id="phas">Add Entry</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </li>
                <li class="item">
                    <strong>Personal / Social History: </strong>
                    <div>
                        <span class="skubbs_output" id="personal-social-val"><?php echo $medical_history['data']->personal_social ?></span>
                        <textarea name="personal_social" id="personal-social" class="form-control skubbs_input" rows="3"><?php echo $medical_history['data']->personal_social ?></textarea>
                    </div>
                </li>
                <li class="item">
                    <strong>Family History: </strong>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="label-primary col-md-4">Relative</th>
                                    <th class="label-primary col-md-8">Desease Details</th>
                                </tr>
                            </thead>
                            <tbody id="family">
                                <?php foreach ($medical_history['data']->family as $family): ?>
                                <tr class="skubbs_output">
                                    <td><?php echo $family[0] ?></td>
                                    <td><?php echo $family[1] ?></td>
                                </tr>
                                <?php endforeach ?>
                                <?php foreach ($medical_history['data']->family as $family): ?>
                                <tr class="skubbs_input">
                                    <td><input type="text" name="family_relative[]" value="<?php echo $family[0] ?>" class="form-control"></td>
                                    <td>
                                        <div class="input-group" style="margin-bottom: 5px">
                                            <input type="text" class="form-control" name="family_desease[]" value="<?php echo $family[1] ?>">
                                            <a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr class="skubbs_input">
                                    <td colspan="2">
                                        <a href="#" class="btn btn-info btn-xs skubbs_btn-add" s-id="family" s-name="relative|desease">Add Entry</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </li>
                <li class="item">
                    <strong>Others: </strong>
                    <div>
                        <span class="skubbs_output" id="other"><?php echo $medical_history['data']->other ?></span>
                        <textarea name="other" id="other" class="form-control skubbs_input" rows="3"><?php echo $medical_history['data']->other ?></textarea>
                    </div>
                </li>
                <li class="item">
                    <div class="btn-group pull-right">
                        <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="#" class="btn btn-primary skubbs_btn-save" style="display:none">Save</a>
                        <a href="#" class="btn btn-default skubbs_btn-cancel" style="display:none">Cancel</a>
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class="overlay skubbs_loading"><i class="fa fa-refresh fa-spin"></i></div>
</div>