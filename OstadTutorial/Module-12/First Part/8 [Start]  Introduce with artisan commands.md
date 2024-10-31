# 8 [Start] Introduce with artisan commands

-   **php artisan ui vue:**
    -   এই কমান্ডটি আপনার অ্যাপ্লিকেশনে Vue.js ফ্রেমওয়ার্কের জন্য একটি স্কেফোল্ডিং সেট আপ করে।
-   **php artisan ui react:**
    -   এই কমান্ডটি আপনার অ্যাপ্লিকেশনে React.js ফ্রেমওয়ার্কের জন্য একটি স্কেফোল্ডিং সেট আপ করে।
-   **php artisan ui bootstrap:**
    -   এই কমান্ডটি আপনার অ্যাপ্লিকেশনে Bootstrap ফ্রেমওয়ার্কের জন্য একটি স্কেফোল্ডিং সেট আপ করে।
-   **php artisan preset none:**
    -   এই কমান্ডটি কোনো ধরনের স্কেফোল্ডিং ব্যবহার না করার জন্য সেট করে।
        আমাদের আগে শেখা উপরের কমান্ড গুলো বর্তমানে আমরা ব্যবহার না করে আমরা আধুনিক পদ্ধতি ব্যবহার করবো যা লারাভেল সাজেস্ট করে তা হলো inertia ব্যবহার করা। আর যদি আমাদের প্রোজেক্ট Monolithic (মানে প্রন্ট এন্ড, ব্যাক এন্ড এক সাথে থাকে ) না হয় তবে এগুলোর কোনকিছু ই দরকার হবে না।

## লারাভেলে Inertia.js: একটি সহজ ব্যাখ্যা

**Inertia.js** হল একটি জাভাস্ক্রিপ্ট লাইব্রেরি যা আপনাকে লারাভেল ব্যাকএন্ড এবং আপনার পছন্দের যেকোনো ফ্রন্টএন্ড ফ্রেমওয়ার্ক (যেমন Vue, React, Svelte) এর মধ্যে একটি সহজ এবং দ্রুত সংযোগ স্থাপন করতে সাহায্য করে। এটি মূলত একটি পৃষ্ঠা রিফ্রেশ ছাড়াই সিঙ্গল পেজ অ্যাপ্লিকেশন (SPA) তৈরি করার একটি উপায়।

### কেন Inertia.js ব্যবহার করবেন?

-   **সহজ ইন্টারফেস:** Inertia.js আপনাকে Laravel এর রাউট এবং কন্ট্রোলার থেকে সরাসরি আপনার ফ্রন্টএন্ড কম্পোনেন্টে ডাটা পাঠাতে দেয়, যা আপনার কোডবেসকে আরও পরিষ্কার এবং বোধগম্য করে তোলে।
-   **সিঙ্গল পেজ অ্যাপ্লিকেশন (SPA):** Inertia.js ব্যবহার করে আপনি একটি SPA তৈরি করতে পারবেন, যা ব্যবহারকারীর অভিজ্ঞতা উন্নত করে কারণ পৃষ্ঠাটি পুরোপুরি রিফ্রেশ হয় না।
-   **ফ্রেমওয়ার্ক নিরপেক্ষ:** আপনি যেকোনো ফ্রন্টএন্ড ফ্রেমওয়ার্কের সাথে Inertia.js ব্যবহার করতে পারেন, যা আপনাকে আপনার পছন্দের টুল ব্যবহার করতে দেয়।
-   **সার্ভার-সাইড রেন্ডারিং (SSR):** Inertia.js SSR-কে সমর্থন করে, যা আপনার অ্যাপ্লিকেশনকে SEO-এর জন্য আরও ভাল করে তোলে।

### কীভাবে Inertia.js কাজ করে?

1. **ক্লায়েন্ট-সাইড রিকোয়েস্ট:** যখন ব্যবহারকারী একটি লিঙ্কে ক্লিক করে বা একটি ফর্ম সাবমিট করে, তখন ব্রাউজার একটি HTTP রিকোয়েস্ট লারাভেল ব্যাকএন্ডে পাঠায়।
2. **সার্ভার-সাইড রেসপন্স:** লারাভেল রিকোয়েস্টটি হ্যান্ডেল করে এবং একটি JSON রেসপন্স পাঠায়, যার মধ্যে রয়েছে নতুন কম্পোনেন্ট এবং প্রোপার্টি যা রেন্ডার করতে হবে।
3. **ক্লায়েন্ট-সাইড আপডেট:** Inertia.js এই JSON রেসপন্সটি গ্রহণ করে এবং বর্তমান পৃষ্ঠার একটি নতুন সংস্করণ রেন্ডার করে, যা মূলত একটি পৃষ্ঠা রিফ্রেশ ছাড়াই DOM আপডেট করে।

### Inertia.js এর সুবিধা

-   **দ্রুত ডেভেলপমেন্ট:** Inertia.js আপনাকে দ্রুত এবং সহজে একটি SPA তৈরি করতে সাহায্য করে।
-   **ভাল পারফরম্যান্স:** Inertia.js পৃষ্ঠা রিফ্রেশ কম করে, যা আপনার অ্যাপ্লিকেশনকে আরও দ্রুত করে তোলে।
-   **সহজ মেইনটেনেন্স:** Inertia.js আপনার কোডবেসকে আরও পরিষ্কার এবং বোধগম্য করে তোলে, যা মেইনটেনেন্সকে সহজ করে।
-   **সম্প্রদায়:** Inertia.js এর একটি বড় এবং সক্রিয় সম্প্রদায় রয়েছে, যা আপনাকে সাহায্য করতে পারে যদি আপনার কোনো সমস্যা হয়।

**উপসংহার:**

Inertia.js হল একটি দুর্দান্ত টুল যা আপনাকে লারাভেল ব্যাকএন্ড এবং আপনার পছন্দের ফ্রন্টএন্ড ফ্রেমওয়ার্কের মধ্যে একটি সহজ এবং দ্রুত সংযোগ স্থাপন করতে সাহায্য করে। যদি আপনি একটি SPA তৈরি করতে চান, তাহলে Inertia.js একটি দুর্দান্ত বিকল্প।

## লারাভেলের Artisan UI কমান্ড এবং Inertia.js এর তুলনা

আপনি যে কমান্ডগুলো উল্লেখ করেছেন সেগুলো লারাভেল অ্যাপ্লিকেশনে দ্রুত ফ্রন্ট-এন্ড স্কেফোল্ডিং তৈরির জন্য ব্যবহৃত হয়। তবে, Inertia.js একটি ভিন্ন ধরনের সমাধান। আসুন তাদের মধ্যে পার্থক্য এবং Inertia.js ব্যবহারের সুবিধাগুলো বিস্তারিতভাবে বুঝি:

### Artisan UI কমান্ডগুলো কী করে?

-   **php artisan ui vue, php artisan ui react, php artisan ui bootstrap:** এই কমান্ডগুলো আপনার লারাভেল অ্যাপ্লিকেশনে নির্দিষ্ট ফ্রেমওয়ার্ক (Vue, React, Bootstrap) এর জন্য একটি বেসিক স্ট্রাকচার তৈরি করে। এতে সাধারণত কিছু কম্পোনেন্ট, রাউট এবং স্টাইল ফাইল থাকে যাতে আপনি দ্রুত আপনার অ্যাপ্লিকেশন ডেভেলপমেন্ট শুরু করতে পারেন।
-   **php artisan preset none:** এই কমান্ডটি কোনো ধরনের ফ্রন্ট-এন্ড স্কেফোল্ডিং ব্যবহার না করে আপনার অ্যাপ্লিকেশনকে একটি খালি স্টেটে রাখে।

### Inertia.js কী?

Inertia.js হল একটি জাভাস্ক্রিপ্ট লাইব্রেরি যা আপনাকে লারাভেল ব্যাকএন্ড এবং আপনার পছন্দের যেকোনো ফ্রন্টএন্ড ফ্রেমওয়ার্কের মধ্যে একটি সহজ এবং দ্রুত সংযোগ স্থাপন করতে সাহায্য করে। এটি মূলত একটি পৃষ্ঠা রিফ্রেশ ছাড়াই সিঙ্গল পেজ অ্যাপ্লিকেশন (SPA) তৈরি করার একটি উপায়।

### Inertia.js ব্যবহারের সুবিধা

-   **সহজ ইন্টারফেস:** Laravel এর রাউট এবং কন্ট্রোলার থেকে সরাসরি আপনার ফ্রন্টএন্ড কম্পোনেন্টে ডাটা পাঠানো খুব সহজ।
-   **সিঙ্গল পেজ অ্যাপ্লিকেশন (SPA):** পৃষ্ঠা রিফ্রেশ ছাড়াই একটি স্মুথ ব্যবহারকারীর অভিজ্ঞতা প্রদান করে।
-   **ফ্রেমওয়ার্ক নিরপেক্ষ:** আপনি যেকোনো ফ্রন্টএন্ড ফ্রেমওয়ার্কের সাথে ব্যবহার করতে পারেন।
-   **সার্ভার-সাইড রেন্ডারিং (SSR):** SEO-এর জন্য ভাল।

### Artisan UI এবং Inertia.js এর মধ্যে পার্থক্য

| বৈশিষ্ট্য  | Artisan UI                                                   | Inertia.js                                                        |
| ---------- | ------------------------------------------------------------ | ----------------------------------------------------------------- |
| কাজ        | নির্দিষ্ট ফ্রেমওয়ার্কের জন্য একটি বেসিক স্ট্রাকচার তৈরি করে | লারাভেল এবং ফ্রন্টএন্ড ফ্রেমওয়ার্কের মধ্যে একটি সংযোগ স্থাপন করে |
| নমনীয়তা   | কম নমনীয়                                                    | খুব নমনীয়                                                        |
| SPA সমর্থন | সীমিত                                                        | সম্পূর্ণ সমর্থন করে                                               |
| SSR সমর্থন | সীমিত                                                        | সম্পূর্ণ সমর্থন করে                                               |

### কখন কোনটি ব্যবহার করবেন?

-   **দ্রুত একটি প্রোটোটাইপ তৈরি করতে:** Artisan UI কমান্ডগুলো ব্যবহার করতে পারেন।
-   **একটি বড় এবং জটিল SPA তৈরি করতে:** Inertia.js ব্যবহার করতে পারেন।
-   **আপনার পছন্দের ফ্রেমওয়ার্ক এবং স্টাইল ব্যবহার করতে:** Inertia.js ব্যবহার করতে পারেন।

**উপসংহার:**

Inertia.js সাধারণত Artisan UI কমান্ডগুলোর চেয়ে বেশি নমনীয় এবং শক্তিশালী। যদি আপনি একটি বড় এবং জটিল অ্যাপ্লিকেশন তৈরি করতে চান, তাহলে Inertia.js একটি ভাল বিকল্প। তবে, যদি আপনি দ্রুত একটি প্রোটোটাইপ তৈরি করতে চান, তাহলে Artisan UI কমান্ডগুলো ব্যবহার করতে পারেন।

---

Laravel এর **front-end scaffolding** বলতে বোঝায় একটি সহজ ব্যবস্থা যা Laravel আপনার জন্য তৈরি করে, যাতে আপনি দ্রুত ও সহজে একটি প্রাথমিক ফ্রন্টএন্ড ইন্টারফেস সেটআপ করতে পারেন। এটি মূলত বিভিন্ন JavaScript framework বা CSS library এর মাধ্যমে ফ্রন্টএন্ডের অংশগুলো দ্রুত তৈরি করতে সাহায্য করে।

যখন আপনি Laravel প্রজেক্ট তৈরি করেন, তখন Laravel আপনাকে ফ্রন্টএন্ডের জন্য কিছু **প্রাক-প্রস্তুত কোড** (scaffolding) দিয়ে সাহায্য করতে পারে। Laravel স্বয়ংক্রিয়ভাবে এই scaffolding সেটআপ করে দেয়, যাতে আপনি JavaScript বা CSS এর ম্যানুয়াল সেটআপ নিয়ে ঝামেলায় না পড়েন। এটি বিশেষভাবে Vue.js, React.js, বা Bootstrap এর মত জনপ্রিয় ফ্রন্টএন্ড টুলগুলোর সাথে কাজ করার জন্য ব্যবহৃত হয়।

**কেন দরকার?**

-   Laravel মূলত ব্যাকএন্ড ফ্রেমওয়ার্ক হলেও, অনেক সময় ডেভেলপাররা চাইতে পারেন ফ্রন্টএন্ড কাজও দ্রুত করতে।
-   Scaffolding আপনাকে প্রাথমিকভাবে একটি working front-end দিয়ে দেয়, যাতে আপনি পরে সেটি কাস্টমাইজ করতে পারেন।

### উদাহরণ:

1. আপনি যদি `Vue.js` দিয়ে কাজ করতে চান, তাহলে Laravel একটি সহজ কমান্ড দিয়ে Vue এর জন্য প্রাথমিক সেটআপ তৈরি করে দেয়।

    ```
    php artisan ui vue
    ```

2. একইভাবে, আপনি `React.js` ব্যবহার করতে চাইলে:
    ```
    php artisan ui react
    ```

Laravel এর front-end scaffolding এর কাজ হচ্ছে, আপনার জন্য ফ্রন্টএন্ড কোডের একটা বেসলাইন তৈরি করা, যাতে আপনাকে হাতেকলমে সবকিছু শুরু করতে না হয়।