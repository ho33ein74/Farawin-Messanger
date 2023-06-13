این پروژه صرفا بیس و پایه یک اسکریپت رزرواسیون حرفه ای می باشد.

بخش های موجود در این پروژه:
- مدیریت فروش
- انبارداری
- حسابداری
- درگاه آنلاین
- رزرو آنلاین
- مدیریت خدمات
- مدیریت کارکنان و پرسنل
- تقویم کاری
- ارسال پیامک به مشتریان
- و ...

برای انتشار در **مارکت راست چین** فایل های زیر می بایست encode شود.

**controller:**
- admin.php
- rtlThemeTrait.php

**model:**
- model_admin.php
- rtlThemeModelTrait.php

**view:**
- license/active.php

**core:**
- controller.php
- model.php

**install:**
- requirements.php
- install.class.php


برای قابل نصب بودن اسکریپت می بایست در فایل index.php در روت اصلی پروژه در خط 10 مقدار متغیر $app_state برابر با pre_installation قرار بگیرد.

`$app_state = "pre_installation";`

همچنین دیتابیس خالی و فایل **config.php** از داخل پوشه حذف شود.

