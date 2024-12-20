Laravel এ Pagination আমাদের অনেক কাজ সহজ করে দিয়েছে, বিশেষ করে যখন ডাটাবেসে অনেকগুলো রেকর্ড থাকে এবং প্রতিটি পেইজে সীমিত সংখ্যক রেকর্ড দেখাতে চাই। Pagination এর মাধ্যমে আমরা ডাটাকে পেজে ভাগ করে দেখাতে পারি এবং ব্যবহারকারীর জন্য এটি নেভিগেশন সহজ করে দেয়।

### Pagination এর প্রয়োজনীয়তা:

অনেক সময় আমাদের ডাটাবেসে অনেকগুলো রেকর্ড থাকে যা একসাথে দেখানো সম্ভব নয়। পেজিনেশন ব্যবহার করে আমরা একবারে নির্দিষ্ট সংখ্যক রেকর্ড প্রদর্শন করতে পারি, ফলে পেইজ লোডিং টাইম কমে এবং ব্যবহারকারী সহজে ডেটা দেখতে পারেন।

Laravel এ Pagination এর জন্য দুইটি প্রধান মেথড আছে:

1. `paginate()`
2. `simplePaginate()`

### 1. `paginate()` মেথড:

এই মেথডটি আমাদের জন্য সম্পূর্ণ পেজিনেশন তৈরির কাজ করে দেয়, যেখানে বিভিন্ন পেইজ নম্বর থাকে এবং প্রতিটি পেইজে নির্দিষ্ট সংখ্যক রেকর্ড দেখানো হয়। `paginate()` মেথডটি ব্যবহার করলে Laravel আমাদের জন্য নেক্সট, প্রিভিয়াস এবং বিভিন্ন পেজ নম্বরের জন্য লিঙ্ক তৈরি করে দেয়।

**উদাহরণ:**

```php
class DemoController extends Controller
{
    public function DemoAction()
    {
        return Product::paginate(5);
    }
}
```

এখানে, `paginate(5)` দিয়ে আমরা বলছি যে, প্রতি পেইজে ৫টি রেকর্ড দেখাতে চাই। Laravel স্বয়ংক্রিয়ভাবে পেজিনেশন হ্যান্ডেল করবে এবং নেভিগেশনের জন্য লিঙ্ক তৈরি করবে।

**উদাহরণ আউটপুট:**
Laravel ভিউতে এটি `<div class="pagination">...</div>` আকারে পেজিনেশন লিঙ্কের HTML কোড তৈরি করবে, যেখানে ব্যবহারকারী বিভিন্ন পেইজ নম্বর ক্লিক করে নেভিগেট করতে পারবেন।

### 2. `simplePaginate()` মেথড:

`simplePaginate()` মেথডটি `paginate()` এর একটি সহজ সংস্করণ। এটি শুধু নেক্সট এবং প্রিভিয়াস বাটন দেখায়, পেজ নম্বর দেখায় না। যদি আমাদের ডেটা একটু কম এবং নেভিগেশন কম দরকার হয়, তবে এটি ব্যবহার করতে পারি।

**উদাহরণ:**

```php
class DemoController extends Controller
{
    public function DemoAction()
    {
        return Product::simplePaginate(5);
    }
}
```

এখানে, `simplePaginate(5)` দিয়ে প্রতি পেইজে ৫টি রেকর্ড দেখানো হবে এবং শুধু নেক্সট ও প্রিভিয়াস বাটন থাকবে।

### Pagination মেথড কাস্টমাইজেশন:

Laravel এ `paginate()` মেথডকে আমরা আরো কাস্টমাইজ করতে পারি। যেমন, প্রতিটি পেইজে কতগুলো রেকর্ড থাকবে, কোন কোন কলামগুলো দেখাতে চাই, এবং পেজের নাম কী হবে তা কাস্টমাইজ করা যায়।

**কাস্টমাইজড Pagination উদাহরণ:**

```php
class DemoController extends Controller
{
    public function DemoAction()
    {
        return Product::paginate(
            $perPage = 10,         // প্রতি পেইজে ১০টি রেকর্ড দেখানো হবে
            $columns = ['*'],      // সবগুলো কলাম দেখাবে, নির্দিষ্ট কলাম দেখাতে চাইলে এখানে এরে হিসেবে কলাম নাম গুলো দিবেন
            $pageName = 'ItemPage' // ডিফল্ট 'page' এর বদলে 'ItemPage' নাম ব্যবহার করা হবে
        );
    }
}
```

**কাস্টমাইজেশনের মাধ্যমে আমরা যা করতে পারি:**

- `$perPage = 10`: এখানে প্রতিটি পেইজে ১০টি রেকর্ড প্রদর্শন করা হবে।
- `$columns = ['*']`: এখানে আমরা বলতে পারি কোন কোন কলাম দেখতে চাই। `['*']` মানে সব কলাম। নির্দিষ্ট কিছু কলাম চাইলে, এখানে সেই কলাম গুলোর নাম দিতে হবে যেমন, `['name', 'price']`।
- `$pageName = 'ItemPage'`: পেজিনেশন প্যারামিটারটি কাস্টমাইজ করার জন্য পেইজের নাম পরিবর্তন করতে পারি। সাধারণত এটি `page` হয়, কিন্তু এখানে আমরা এটিকে `ItemPage` হিসেবে কাস্টমাইজ করেছি।

### Pagination এর ডেটা দেখানো:

Pagination মেথড থেকে ডেটা রিটার্ন করার পরে, আমরা Blade টেম্পলেট ফাইলের মাধ্যমে সহজে এই ডেটা এবং পেজিনেশন লিঙ্ক দেখাতে পারি। উদাহরণ:

```php
@foreach ($products as $product)
    <p>{{ $product->name }} - {{ $product->price }}</p>
@endforeach

{{ $products->links() }}
```

এখানে, `links()` মেথডটি পেজিনেশন লিঙ্ক দেখানোর জন্য ব্যবহৃত হয়।

### Pagination এর জন্য প্রয়োজনীয় কিছু টিপস:

- `paginate()` ব্যবহার করলে Laravel ব্যাকএন্ডে SQL LIMIT এবং OFFSET কমান্ড ব্যবহার করে, যা ডেটাবেস থেকে নির্দিষ্ট সংখ্যক রেকর্ড নিয়ে আসে।
- `simplePaginate()` তুলনামূলক হালকা মেথড, তবে এতে পেজ নম্বর থাকে না, শুধু নেক্সট এবং প্রিভিয়াস বাটন থাকে।
- পেজিনেশন ব্যবহারের ক্ষেত্রে `.env` ফাইলে `APP_DEBUG` false রাখা উচিত, কারণ বড় ডেটাবেসে পেজিনেশন লিমিট ব্যাকএন্ডে অনেক বেশি কোয়েরি তৈরি করে।

### সংক্ষেপে:

Laravel এর `paginate()` এবং `simplePaginate()` আমাদের অনেক কোড লেখার ঝামেলা কমিয়ে দেয়। যেখানে প্রয়োজন অনুযায়ী কাস্টমাইজড পেজিনেশন তৈরি করতে পারি এবং যেকোনো টেবিল ডেটা সহজে পেজে ভাগ করে ব্যবহারকারীদের জন্য ডেটা নেভিগেশন তৈরি করতে পারি।

এটি ছিল Pagination এর একটি সংক্ষিপ্ত পরিচিতি। আশাকরি, এটি আপনার পেজিনেশন ব্যবহারের জন্য সহায়ক হবে!
