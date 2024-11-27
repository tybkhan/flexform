<div class="modal fade" id="flexform_design_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <?php echo form_open(admin_url('flexform/update_form'), ['id'=>'flexform_design_form']); ?>
        <input type="hidden" name="id" value="<?php echo $form['id']; ?>">
        <input type="hidden" name="redirect_url" value="<?php echo admin_url('flexform/setup/'.$form['slug']); ?>" />
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo _flexform_lang('design-and-configuration');  ?></h4>
            </div>
            <div class="modal-body">
                <!-- general section -->
                <div class="tw-mb-4">
                    <div class="ff-section">
                        <h5 class="ff-section_title"><?php echo _flexform_lang('general'); ?></h5>
                    </div>
                    <?php $value = (isset($form) && $form['name'] ? $form['name'] : 'Submit'); ?>
                    <?php echo render_input('name', _flexform_lang('form_title'), $value); ?>

                    <?php $value = (isset($form) && $form['submit_btn_name'] ? $form['submit_btn_name'] : 'Submit'); ?>
                    <?php echo render_input('submit_btn_name', 'form_btn_submit_text', $value); ?>
                    <div class="row">
                        <div class="col-md-12  tw-mb-4">
                            <?php $value = (isset($form) && $form['submit_btn_bg_color'] ? $form['submit_btn_bg_color'] : '#0a0a0a'); ?>
                            <?php echo render_color_picker('submit_btn_bg_color', _flexform_lang('form-button-background-color'), $value); ?>
                        </div>
                        <div class="col-md-12  tw-mb-4">
                            <?php $value = (isset($form) && $form['submit_btn_text_color'] ? $form['submit_btn_text_color'] : '#ffffff'); ?>
                            <?php echo render_color_picker('submit_btn_text_color', _flexform_lang('form-button-text-color'), $value); ?>
                        </div>
                        <div class="col-md-12 tw-mb-4">
                            <?php $value = (isset($form) && $form['end_date'] ? $form['end_date'] : ''); ?>
                            <?php echo render_datetime_input('end_date', _flexform_lang('end-date'), $value); ?>
                        </div>
                    </div>
                </div>
                <!-- end general section -->

                <!--  notification section-->
                <div class="tw-mb-4">
                    <div class="ff-section tw-mb-4">
                        <h5 class="ff-section_title"><?php echo _flexform_lang('notification'); ?></h5>
                    </div>
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" name="notify_form_submission"
                               id="notify_form_submission"
                            <?php echo isset($form) && $form['notify_form_submission'] == 1 ? 'checked' : ''; ?>>
                        <label for="notify_form_submission">
                            <?php echo _flexform_lang('allow-notification-on-form-submission'); ?>
                        </label>
                    </div>
                    <div
                        class="select-notification-settings<?php echo isset($form) && $form['notify_form_submission'] == '0' ? ' hide' : ''; ?>">
                        <div class="radio radio-primary radio-inline">
                            <input type="radio" name="notify_type" value="specific_staff"
                                   id="specific_staff"
                                <?php echo isset($form) && $form['notify_type'] == 'specific_staff' || !isset($form) ? 'checked' : ''; ?>>
                            <label
                                for="specific_staff"><?php echo _l('specific_staff_members'); ?></label>
                        </div>
                        <div class="radio radio-primary radio-inline">
                            <input type="radio" name="notify_type" id="roles" value="roles"
                                <?php echo isset($form) && $form['notify_type'] == 'roles' ? 'checked' : ''; ?>>
                            <label for="roles"><?php echo _l('staff_with_roles'); ?></label>
                        </div>
                        <div class="radio radio-primary radio-inline">
                            <input type="radio" name="notify_type" id="assigned"
                                   value="assigned"
                                <?php echo isset($form) && $form['notify_type'] == 'assigned' ? 'checked' : ''; ?>>
                            <label
                                for="assigned"><?php echo _l('notify_assigned_user'); ?></label>
                        </div>
                        <div class="clearfix mtop15"></div>
                        <div id="specific_staff_notify"
                             class="<?php echo isset($form) && $form['notify_type'] != 'specific_staff' ? 'hide' : ''; ?>">
                            <?php
                            $selected = [];
                            if (isset($form) && $form['notify_type'] == 'specific_staff') {
                                $selected = unserialize($form['notify_ids']);
                            }
                            ?>
                            <?php echo render_select('notify_ids_staff[]', $members, ['staffid', ['firstname', 'lastname']], 'leads_email_integration_notify_staff', $selected, ['multiple' => true]); ?>
                        </div>
                        <div id="role_notify"
                             class="<?php echo isset($form) && $form['notify_type'] != 'roles' || !isset($form) ? 'hide' : ''; ?>">
                            <?php
                            $selected = [];
                            if (isset($form) && $form['notify_type'] == 'roles') {
                                $selected = unserialize($form['notify_ids']);
                            }
                            ?>
                            <?php echo render_select('notify_ids_roles[]', $roles, ['roleid', ['name']], 'leads_email_integration_notify_roles', $selected, ['multiple' => true]); ?>
                        </div>
                    </div>
                    <div class="tw-mt-4 tw-mb-4">
                        <?php
                        $selected = isset($form) ? $form['responsible'] : '';
                        foreach ($members as $staff) {
                            if (isset($form) && $form['responsible'] == $staff['staffid']) {
                                $selected = $staff['staffid'];
                            }
                        }
                        ?>
                        <?php echo render_select('responsible', $members, ['staffid', ['firstname', 'lastname']], 'leads_import_assignee', $selected); ?>
                    </div>
                </div>
                <!-- end notification section -->

                <!-- specific configuration for connected module -->
                <?php if(isset($form) && $form['type'] != ''): ?>
                    <?php $this->load->view('setup/configuration/'.$form['type'], ['props' => $props]); ?>
                <?php endif; ?>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo _flexform_lang('save-changes'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
