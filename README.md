📖 مستندات API رز

مجوز

این پروژه تحت مجوز MIT منتشر شده است.

---

🚀 شروع سریع

دریافت API Key

برای دریافت کلید API، به وب‌سایت dev.rosesearch.ir مراجعه کنید.

پس از ثبت‌نام و ورود، دو کلید دریافت خواهید کرد:

· api_key_web - برای جستجوی وب
· api_key_image - برای جستجوی تصاویر

---

🌐 جستجوی وب

اطلاعات عمومی

ویژگی مقدار
نوع درخواست GET
نشانی https://RoseSearch.ir/search_web.php
نوع توکن api_key_web
مصرف اعتبار ۱ واحد در هر درخواست

پارامترها

پارامتر نوع اجباری توضیحات
action string ✅ مقدار ثابت search
api_key string ✅ کلید وب شما
q string ✅ عبارت جستجو
limit integer ❌ تعداد نتایج (پیش‌فرض: ۵۰، حداکثر: ۲۰۰)

نمونه درخواست

```
GET https://RoseSearch.ir/search_web.php?action=search&api_key=YOUR_WEB_KEY&q=عبارت%20جستجو&limit=10
```

ساختار پاسخ موفق

```json
{
  "success": true,
  "query": "عبارت جستجو",
  "normalized_query": "عبارت جستجو",
  "count": 10,
  "results": [
    {
      "id": 123,
      "domain": "example.com",
      "url": "https://example.com/page",
      "title": "عنوان صفحه",
      "description": "توضیحات صفحه",
      "source": "example",
      "saved_at": "2024-01-15 14:30:00",
      "score": 85,
      "match_details": ["تطابق کامل در عنوان", "۲ کلمه در توضیحات"]
    }
  ],
  "token_info": {
    "name": "کاربر",
    "remaining": 14
  }
}
```

خطاهای رایج

```json
// توکن نامعتبر
{
  "error": "توکن نامعتبر",
  "code": "INVALID_TOKEN"
}

// اعتبار کافی نیست
{
  "error": "اعتبار کافی نیست",
  "code": "CREDIT_ERROR"
}
```

---

🖼️ جستجوی تصاویر

اطلاعات عمومی

ویژگی مقدار
نوع درخواست GET
نشانی https://RoseSearch.ir/search_image.php
نوع توکن api_key_image
مصرف اعتبار ۱ واحد در هر درخواست

پارامترها

پارامتر نوع اجباری توضیحات
action string ✅ مقدار ثابت search
api_key string ✅ کلید تصاویر شما
q string ✅ عبارت جستجو
limit integer ❌ تعداد تصاویر (پیش‌فرض: ۳۰، حداکثر: ۶۰)

نمونه درخواست

```
GET https://RoseSearch.ir/search_image.php?action=search&api_key=YOUR_IMAGE_KEY&q=عبارت%20جستجو&limit=10
```

ساختار پاسخ موفق

```json
{
  "success": true,
  "query": "عبارت جستجو",
  "normalized_query": "عبارت جستجو",
  "count": 10,
  "results": [
    {
      "src": "https://example.com/image.jpg",
      "alt": "تصویر",
      "source_title": "example.com",
      "favicon": "https://www.google.com/s2/favicons?domain=example.com&sz=32",
      "source_url": "https://example.com/page"
    }
  ],
  "token_info": {
    "name": "کاربر",
    "remaining_image_credits": 14,
    "remaining_web_credits": 15
  }
}
```

---

📊 کدهای خطا

کد توضیحات
MISSING_TOKEN توکن ارسال نشده است
INVALID_TOKEN توکن نامعتبر یا غیرفعال
MISSING_QUERY عبارت جستجو ارسال نشده است
CREDIT_ERROR خطا در کسر اعتبار
INVALID_ACTION اکشن نامعتبر است

---

💰 سیستم اعتبار

· اعتبار اولیه: ۱۰ واحد وب + ۱۰ واحد تصویر
· مصرف هر درخواست: ۱ واحد
· پاداش کلیک تبلیغات: ۵ واحد (وب + تصویر)
· حداکثر کلیک تبلیغات در روز: ۲۰ بار

---

📧 پشتیبانی

· ایمیل: info@RoseSearch.ir
· وب‌سایت: RoseSearch.ir

---

مجوز: MIT
