<?php

app()->booted(function () {
    theme_option()
        ->setField([
            'id'         => 'allow_member_register',
            'section_id' => 'opt-text-subsection-general',
            'type'       => 'select',
            'label'      => 'Allow member register ?',
            'attributes' => [
                'name'    => 'allow_member_register',
                'list'    => [
                    'no'  => trans('core/base::base.no'),
                    'yes' => trans('core/base::base.yes'),
                ],
                'value'   => 'no',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ]);
});
