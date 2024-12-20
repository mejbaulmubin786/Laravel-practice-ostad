এর আগে আমরা যে তিনটি টেবিল নিয়ে কাজ করেছি যেমন users, categories, brands টেবিল নিয়ে কাজ করেছি যেগুলোতে কোন প্রাইমারি কি ছাড়া কোন ফরেন কি ছিলো না। এবার আমরা profiles টেবিলে চলে যাবো এটাতে কিন্তু ফরেন কি এর ব্যাপার আছে। users টেবিলের যে ইমেইল এডড্রেস সেটিই profiles টেবিলের ফরেন কি হিসেবে ব্যবহৃত হয়েছে। এটিকে মেনেজ করবো কিভাবে। এখানে firstName, lastName, mobile, city, shippingAddress এতটুকু পর্যন্ত সব ঠিক ঠাক আছে

```php
$table->id();
$table->string('firstName', 50);
$table->string('lastName', 50);
$table->string('mobile', 50);
$table->string('city', 50);
$table->string('shippingAddress', 1000);
```

এর পরেই আছে ফরেন কি মানে এর পরের কলাম ই আছে email যা আমাকে এটিকে ফরেন কি হিসেবে ডিক্লার করতে হবে। এবং এটিকে আমাদের রিলেশন শিপ এর আওতায় আনতে হবে users টেবিলের সাথে। এখানে একটি বিষয় লক্ষনিয় যে আমার users টেবিলের ডাটা যদি ইউনিক হয় তবে একটি ইউজার এর জন্য একটিই ইমেইল থাকবে তাই প্রোফাইল টেবিলেও একই ঘটনা মানে একটি ইউজার এর বিপরিতে একটিই ইমেইল এডড্রেস থাকবে তাই প্রোফাইল টেবিলেও আমাদের ইমেইল এডড্রেস ইউনিক রাখতে হবে। এই ইমেইল এডড্রেস কে আমরা ফরেন কি হিসেবে ডিক্লার করবো এর জন্য এটি যে ফরেন কি এটি আমাদের বলে দিতে হবে।

```php
$table->string('email', 50)->unique();
$table->foreign('email')->references('email')->on('users')
```

`$table->foreign('email')->references('email')->on('users')`এর মাধ্যমে আমি বলে দিচ্ছি যে আমার এই টেবিলে email নামে যে কলামটি আছে সেটি একটি ফরেন কি এবং এই ফরেন কি যার সাথে কাজ করবে তার রেফারেন্স দিয়ে দিলাম যে সেটি অন্য আর একটি email কলামের সাথে কাজ করবে সেই email টা কোন টেবিলের users টেবিলের। আরো ভালো করে বুঝার জন্য দেখুন যদি নিচের মতো হতো

```php
$table->string('profile_email', 50)->unique();
$table->foreign('profile_email')->references('email')->on('users');
```

এখানে আমরা কলাম নাম চেঞ্জ করে দেখছি বুঝতে যেনো কোন সমস্যা না হয় তাই `$table->foreign('profile_email')->references('email')->on('users')`
এর মাধ্যমে আমি বলে দিচ্ছি যে আমার এই টেবিলে profile_email নামে যে কলামটি আছে সেটি একটি ফরেন কি এবং এই ফরেন কি যার সাথে কাজ করবে তার রেফারেন্স দিয়ে দিলাম যে সেটি অন্য আর একটি email কলামের সাথে কাজ করবে সেই email টা users টেবিলের। এভাবে ফরেন কি দিরে ফরেন কি দিয়ে যদি আমরা রিলেশনশিপ তৈরি করি তবে ফরেন কি কন্সট্রেন্ট লাগবে এর জন্য আমরা বলে দিলাম

```php
// Relationship
$table->foreign('email')->references('email')->on('users')
      ->restrictOnDelete()
      ->cascadeOnUpdate();
```

final output

### 2. Profiles Table

```php
$table->id();
$table->string('firstName', 50);
$table->string('lastName', 50);
$table->string('mobile', 50);
$table->string('city', 50);
$table->string('shippingAddress', 1000);
$table->string('email', 50)->unique();
// Relationship
$table->foreign('email')->references('email')->on('users')
      ->restrictOnDelete()
      ->cascadeOnUpdate();
$table->timestamp('created_at')->useCurrent();
$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
```

#### ব্যাখ্যা:

- `$table->string('firstName', 50)` এবং `$table->string('lastName', 50)`: এখানে ইউজারের নাম সংরক্ষণ করা হবে (প্রথম নাম এবং শেষ নাম)। প্রতিটি ফিল্ড সর্বোচ্চ ৫০ ক্যারেক্টার ধরে রাখতে পারে।

- `$table->string('mobile', 50)`: ইউজারের মোবাইল নম্বর সংরক্ষণ করবে।

- `$table->string('city', 50)`: ইউজারের শহরের নাম সংরক্ষণ করবে।

- `$table->string('shippingAddress', 1000)`: ইউজারের শিপিং ঠিকানা সংরক্ষণ করবে। এই ফিল্ডটি বড় করা হয়েছে (১০০০ ক্যারেক্টার পর্যন্ত) কারণ ঠিকানার দৈর্ঘ্য বড় হতে পারে।

- `$table->string('email', 50)->unique()`: ইউজারের ইমেইলটি আবার এখানে রাখা হয়েছে, কারণ প্রোফাইল টেবিলটি `users` টেবিলের সাথে সম্পর্কিত এবং ইমেইল হলো ফরেন কী।

- `$table->foreign('email')->references('email')->on('users')`: এখানে আমরা `users` টেবিলের ইমেইল ফিল্ডের সাথে এই টেবিলের ইমেইল ফিল্ডটিকে রিলেট করছি। অর্থাৎ, প্রতিটি প্রোফাইলের সাথে একটি ইউজার থাকতে হবে।

- `->restrictOnDelete()`: যদি মূল `users` টেবিল থেকে কোনো ইউজার মুছে ফেলা হয়, তাহলে প্রোফাইলও মুছে ফেলা হবে না (ডিলিটে বাধা সৃষ্টি করবে)।

- `->cascadeOnUpdate()`: যদি মূল `users` টেবিলের ইমেইল আপডেট করা হয়, তাহলে সেই পরিবর্তন এখানে প্রোফাইল টেবিলেও প্রয়োগ হবে।

---

এই লাইনটি Laravel মাইগ্রেশন কোডের মধ্যে একটি ফরেন কী কনস্ট্রেন্ট (foreign key constraint) তৈরির কাজ করে। আমরা ধাপে ধাপে এটি বিশ্লেষণ করি:

```php
$table->foreign('email')->references('email')->on('users');
```

#### ১. `$table->foreign('email')`

- এখানে বলা হচ্ছে যে আমরা **profiles** টেবিলের `email` কলামকে ফরেন কী হিসেবে ঘোষণা করছি।
- **ফরেন কী** হচ্ছে এমন একটি কলাম যা অন্য একটি টেবিলের প্রাইমারি কী বা ইউনিক কী এর সাথে সম্পর্কিত থাকে।

#### ২. `->references('email')`

- `references('email')` এর মানে হলো, `email` কলামটি অন্য কোনো টেবিলের (এক্ষেত্রে `users` টেবিলের) **email** কলামের সাথে সম্পর্কিত হবে।
- এর মাধ্যমে নিশ্চিত করা হচ্ছে যে **profiles** টেবিলে যেকোনো একটি `email` যোগ করার সময় তা অবশ্যই **users** টেবিলের `email` কলামের একটি মানের সাথে মিলে যেতে হবে। যদি না মিলে, তাহলে সিস্টেম একটি ত্রুটি (error) দেখাবে এবং `profiles` টেবিলে ডাটা ঢোকানো যাবে না।

#### ৩. `->on('users')`

- `on('users')` নির্দেশ করছে যে, `email` ফরেন কী যে টেবিলের সাথে রিলেটেড হবে সেটি হলো **users** টেবিল।
- সংক্ষেপে বলা যায়, এই অংশটি বলছে, "আমি `profiles` টেবিলের `email` কলামকে **users** টেবিলের `email` কলামের সাথে সম্পর্কিত করছি।" এর ফলে **profiles** টেবিলে যেকোনো ইমেইল অ্যাড্রেস ঢোকানোর আগে তা যাচাই করা হবে যে **users** টেবিলে সেই ইমেইল অ্যাড্রেসটি আছে কিনা।

---

```php
$table->string('email', 50)->unique();
$table->foreign('email')->references('email')->on('users')
```

এখানে আর একটি বিষয় লক্ষনিয় আমরা চাইলে ভিন্ন নামেও তৈরি করতে পারতাম।

```php
$table->string('emailID', 50)->unique();
$table->foreign('emailID')->references('email')->on('users')
```

যেহুতু এটিকে ফরেন কি হিসেবে ডিকলার করেছি তাই এদের মাঝে কনস্ট্রেন্ট যুক্ত করেছি।

```php
->restrictOnDelete()
->cascadeOnUpdate();
```

#### কেন দরকার হয়?

1. **ডেটা ইন্টিগ্রিটি**: এই ফরেন কী কনস্ট্রেন্ট নিশ্চিত করে যে, **profiles** টেবিলে শুধুমাত্র সেসব ইমেইল যোগ করা যাবে যেগুলো **users** টেবিলে আগে থেকেই বিদ্যমান আছে। এটি ডেটার সামঞ্জস্য বজায় রাখে।
2. **রিলেশনশিপ ধরে রাখা**: এটি `profiles` এবং `users` টেবিলের মধ্যে একটি রিলেশনশিপ তৈরি করে। এই রিলেশনশিপের মাধ্যমে আমরা জানাতে পারি যে, প্রতিটি প্রোফাইল একটি নির্দিষ্ট ইউজারের সাথে সম্পর্কিত এবং প্রোফাইল তৈরির আগে সেই ইউজারকে `users` টেবিলে থাকতে হবে।

3. **ডেটাবেস কনসিস্টেন্সি**: এর মাধ্যমে নিশ্চিত করা হয় যে, কোনো ইউজার **users** টেবিলে না থাকা অবস্থায় তার জন্য প্রোফাইল তৈরি করা যাবে না।

#### উদাহরণ:

ধরা যাক, **users** টেবিলে নিচের মতো কিছু ডাটা আছে:

| id  | email          |
| --- | -------------- |
| 1   | alice@test.com |
| 2   | bob@test.com   |

এখন, **profiles** টেবিলে যদি নতুন একটি প্রোফাইল যোগ করতে চাই যেখানে ইমেইল হলো `charlie@test.com` (যেটি **users** টেবিলে নেই), তাহলে ডাটাবেস এটি গ্রহণ করবে না কারণ `charlie@test.com` **users** টেবিলে বিদ্যমান নেই। তবে, যদি `email` হিসেবে `alice@test.com` বা `bob@test.com` ব্যবহার করি, তাহলে প্রোফাইল যোগ করা সম্ভব হবে।

---

#### অতিরিক্ত কনফিগারেশন:

Laravel এর মাইগ্রেশন ব্যবহার করে `onDelete` এবং `onUpdate` ইভেন্টও সেট করা যায়:

```php
$table->foreign('email')
      ->references('email')
      ->on('users')
      ->onDelete('cascade')
      ->onUpdate('cascade');
```

- **onDelete('cascade')**: যখন **users** টেবিল থেকে কোনো ইউজার ডিলিট করা হবে, সেই ইউজারের সাথে সম্পর্কিত সমস্ত প্রোফাইল স্বয়ংক্রিয়ভাবে ডিলিট হয়ে যাবে।
- **onUpdate('cascade')**: যদি **users** টেবিলের কোনো ইউজারের ইমেইল পরিবর্তন করা হয়, তবে সেই ইউজারের সাথে সম্পর্কিত সমস্ত প্রোফাইলের ইমেইল স্বয়ংক্রিয়ভাবে আপডেট হয়ে যাবে।

এগুলো `foreign key` সম্পর্কিত অতিরিক্ত ফিচার যা ডেটা ম্যানেজমেন্টকে আরো সহজ করে।
