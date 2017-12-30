<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'آدرس ایمیل معتبر نیست',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => ':attribute را تعیین کنید',
    'image'                => ':attribute آپلود شده باید از نوع عکس باشد',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'حجم :attribute  نباید بزرگتر از :max کیلوبایت باشد',
        'string'  => ':attribute حداکثر باید :max کارکتر داشته باشد',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => ' :attribute باید از نوع :values  باشد'  ,
    'mimetypes'            => ' :attribute باید از نوع :values باشد',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => ':attribute حداقل باید :min کارکتر داشته باشد',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'برای :attribute تنها مجاز به استفاده از کارکتر های مجاز هستید',
    'required'             => ' بخش :attribute را کامل کنید',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
//    'same'                 => ':attribute و :other مطابق نیستند',
    'same'                 => ' رمز عبور را نادرست تکرار کرده اید',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => ':attribute قبلا ثبت شده است',
    'uploaded'             => ' :attribute آپلود نشد',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        'username' => 'نام کاربری',
        'password' => 'کلمه عبور',
        'repeat' => 'تایید رمز عبور',
        'email' =>'ایمیل',
        'gender' => 'جنسیت',
        'fName' => 'نام',
        'lName' => 'نام خانوادگی',
        'national_code' => 'کد ملی',
        'phone_number' => 'شماره تماس',
        'accountNumber' => 'شماره حساب بانکی',
        'owner' => 'دارنده حساب',
        'bank'=> 'بانک',
        'city' => 'شهر',
        'address' => 'آدرس',
        'postal_code' => 'کد پستی',
        'path' => 'عکس',
        'confirm' => 'کد تایید',
        'message' => 'پیام',
        'contact_name' => 'نام',
        'money' => 'مبلغ',
        'url' => 'آدرس مسابقه',
        'matchName' => 'نام مسابقه',
        'startTime' => 'زمان شروع',
        'endTime' => 'زمان پایان',
        'cost'=> 'هزینه ثبت نام',
        'telegram'=> 'تلگرام',
        'rulesPath'=>'فایل قوانین',
        'file' => 'آپلود قوانین',
        'comment' => 'توضیحات',
        'prize' => 'جوایز',
        'plan' => 'برنامه مسابقات',
        'timeline'=>'زمان بندی مسابقات',
        'imageFile'=>'فایل',
        'additionalData'=> 'اطلاعات درخواست شده',
        'teamName'=> 'نام تیم',
        'teammate'=> 'اعضای تیم',
        'teamLogo' => 'لوگو',
        'OrgName'=> 'نام سازمان'
        //        'mode' => 'حضور در مسابقه',
//        'matchType' => 'نوع مسابقه',
//        'maxAttenders' => 'حداکثر تعداد شرکت کنندگان'


    ],



];
