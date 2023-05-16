این پروژه صرفا بیس و پایه یک اسکریپت رزرواسیون حرفه ای می باشد.

بخش های موجود در این پروژه:
- مدیریت فروش
- انبارداری
- حسابداری
- درگاه آنلاین
- رزرو آنلاین
- و ...

برای انتشار در **مارکت راست چین** فایل های زیر می بایست encode شود و فایل هایی که در اسامی آن **orginal** وجود دارد حذف گردد.

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
- public-function.php
- private-function.php

**install:**
- index.php
- do_install.php


برای قابل نصب بودن اسکریپت می بایست در فایل index.php در روت اصلی پروژه در خط 27 مقدار متغیر $app_state برابر با pre_installation قرار بگیرد.

`$app_state = "pre_installation";`

همچنین دیتابیس خالی و فایل **config-example.php** جایگزین **config.php** شود.

