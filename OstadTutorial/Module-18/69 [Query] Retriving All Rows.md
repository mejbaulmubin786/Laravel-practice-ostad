### লারাভেল Query Builder দিয়ে ডাটা ফেচ করার প্রাথমিক ধাপ

Query Builder এর মাধ্যমে ডাটাবেসে কুয়েরি করার জন্য প্রথমেই আমাদের ডাটাবেসের সাথে অ্যাপ্লিকেশনের কানেকশন তৈরি করতে হবে। লারাভেলে সাধারণত `.env` ফাইলে ডাটাবেসের সেটআপ করা হয়।

এই উদাহরণে আমরা `laravel` নামে একটি ডাটাবেস তৈরি করেছি এবং সেটির সাথে কানেকশন স্থাপন করেছি। এবার আমরা প্রাকটিসের জন্য একটি `DemoController` নামে কন্ট্রোলার তৈরি করবো এবং তার মধ্যে `DemoAction` নামে একটি মেথড লিখবো। এই মেথডটি একটি রাউটের মাধ্যমে অ্যাক্সেসযোগ্য হবে।

### রাউট সেটআপ

প্রথমে আমরা নিচের কোডটি ব্যবহার করে একটি রাউট তৈরি করে নিবো, যা মূল পৃষ্ঠায় অর্থাৎ `/` URL-এ আমাদের কন্ট্রোলারের `DemoAction` মেথডটি চালাবে।

```php
Route::get('/', [DemoController::class, 'DemoAction']);
```

### কন্ট্রোলার ও মেথড তৈরি

এবার `DemoController` কন্ট্রোলার এবং তার মধ্যে `DemoAction` মেথড তৈরি করা হলো। এখানে `DB` ফ্যাসাড ব্যবহার করে `products` টেবিল থেকে সব ডাটা রিট্রিভ করবো।

প্রথমেই আমাদের `DB` ফ্যাসাডটি কন্ট্রোলারে ব্যবহার করতে হবে। এটি লারাভেল-এর মধ্যে `Illuminate\Support\Facades\DB` পাথ থেকে ইনক্লুড করতে হয়।

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DemoController extends Controller {
    public function DemoAction() {
        // DB ফ্যাসাড ব্যবহার করে টেবিল থেকে ডাটা রিট্রিভ করা
        return DB::table('products')->get();

        // চাইলে ডাটাকে ভেরিয়েবল এ রেখে ব্যবহার করতে পারি
        // $products = DB::table('products')->get();
        // return $products;
    }
}
```

এই মেথডটি এক্সিকিউট করার পর `products` টেবিলের সকল ডাটা JSON ফরম্যাটে পাওয়া যাবে।

### JSON ফরম্যাটে ডাটা পাওয়া ও প্রদর্শন

লারাভেলের একটি মজার বৈশিষ্ট্য হলো, ডাটাবেজ থেকে ডাটা রিট্রিভ করার পর লারাভেল সেটিকে স্বয়ংক্রিয়ভাবে JSON ফরম্যাটে কনভার্ট করে ফেলে, যা সাধারণত এসোসিয়েটিভ অ্যারের আকারে পাওয়া যায়। এর ফলে আমাদের আলাদা করে JSON ফরম্যাটে কনভার্ট করার দরকার পড়ে না।

যদি সাধারণ ব্রাউজারে JSON ডাটা ভিউ না হয়, তবে পোস্টম্যান (Postman) ব্যবহার করে সহজেই ডাটা পরীক্ষা করা যাবে। পোস্টম্যান JSON ভিউ প্রদর্শনের জন্য বেশ সুবিধাজনক।

---

Query Builder দিয়ে আমাদের Query প্রেকটিস করার জন্য শুরুতেই আমাদের ডাটাবেইজ এর সাথে এপ্লিকেশন এর কানেকশন বিল্ডআপ করতে হবে। এর জন্য আমরা env ফাইল ভ্যবহার করবো। আমরা laravel নামে একটি ডাটাবেইজ নিচ্ছি এর জন্য। পেকটিসের জন্য একটি DemoController নামে একটি Controller তৈরি করে নিলাম সাথে এর মাঝে DemoAction নামে একটি মেথড তৈরি করে নিলাম। এবার প্রয়োজনিয় রাউট টি তৈরি করে নিলাম `Route::get('/', [DemoController::class, 'DemoAction']);` এবার আমরা যা প্রেকটিস করবো তা হচ্ছে যে কোন একটি টেবিল থেকে সব গুলো ডাটা কি করে এক্সট্রেক্ট করা যায় তা । Query Builder দিয়ে কাজ করার জন্য প্রথমেই আমাদের DB নামে একটি ক্লাস আছে এটি ইউজ করে নিতে হবে `use Illuminate\Support\Facades\DB;`। এর পর DB থেকে table ফাংশন কে কল করতে হবে। এই table ফাংশনে কোন টেবিল থেকে আমরা একচুয়ালী কোন টেবিল থেকে ডাটাকে রিট্রিভ করবো সেই টেবিলের নাম প্যারামিটার হিসেবে দিবো `DB::table('products')->get()`। এখানে প্রোডাক্ট টেবিলের সকল ডাটা আমরা জেসন আকারে পেয়ে যাবো। এটি লারাভেল এর একটি মজার বিষয় যে নরমালি আমরা যখন ডাটাবেজ থেকে ডাটা ফেচ করি তখন তা এসোসিয়েটিভ এরে আকারে থাকে কিন্তু লারাভেল সেটি কে নিজেই জেসন এরে আকারে কনভার্ট করে আমাদের দেয় এর জন্য আমরাদের আলাদা কোন কোর্ড লিখতে হয় না। ।

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\BD;

use Illuminate\Support\Facades\DB;

class DemoController extends Controller {
    function DemoAction() {
        return DB::table('products')->get();
        // আমরা সরাসরি রিনার্ট করেছি কিন্তু আমরা চাইলে একটি ভেরিয়েবল এ রেখে $products = DB::table('products')->get(); সেই ভেরিয়েবল কে রিটার্ন করতে পারি return $products;
    }
}
```

এখন আমাদের এই DemoAction ফাংশনটি একজিকিউট হলে পোডাক্ট টেবিলে যতো গুলো ডাটা আছে সবগুলো সিলেক্ট হয়ে চলে আসবে এবং সেটি জেসন আকারে পাওয়া যাবে। কোন কারন বসত অনেক সময় সাধারণ ব্রাউজারে জেসন ভিউ না ও দেখা যেতে পারে এর জন্য আমরা পোস্টম্যান ব্যাবহার করা টাই সুবিধাজনক।