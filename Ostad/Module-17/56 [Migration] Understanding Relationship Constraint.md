![alt text](image-3.png)

### ডাটাবেইজ রিলেশনশিপ এবং কনস্ট্রেইন্টস

**ডাটাবেইজ ডিজাইনের গুরুত্ব**  
ডাটাবেইজ ডিজাইন একটি সিস্টেমের বেসিক অংশ। যখন আমরা Entity Relationship Diagram (ERD) ডিজাইন করি, তখন ডাটাবেইজ টেবিলের মধ্যে সম্পর্ক (relationship) স্পষ্ট হয়। এই সম্পর্ক গুলো সঠিকভাবে চিহ্নিত করতে পারলে ডাটাবেইজের পুরো কাঠামো পরিষ্কার হয়ে যায় এবং কীভাবে ডেটা প্রবাহিত হবে তা সহজেই বুঝতে পারি। বিশেষ করে Laravel এর মতো ফ্রেমওয়ার্ক ব্যবহার করার সময়, ডাটাবেইজের প্রাইমারি এবং ফরেন কী নির্ধারণ করা এবং মাইগ্রেশন (migration) ফাইলের মাধ্যমে টেবিল তৈরি করা সহজ হয়। কিন্তু শুধুমাত্র টেবিল তৈরি করা যথেষ্ট নয়; রিলেশনশিপ এবং কনস্ট্রেইন্টগুলো সঠিকভাবে সেট করা অপরিহার্য।

### সম্পর্কের ধরন

ডাটাবেইজ ডিজাইন করার সময় বিভিন্ন ধরনের সম্পর্ক থাকতে পারে:

1. **One-to-One**: একটি টেবিলের একটি রো-এর সাথে আরেকটি টেবিলের একটি রো যুক্ত থাকে। উদাহরণ: `users` এবং `profiles` টেবিল।
2. **One-to-Many**: একটি টেবিলের একটি রো, অন্য টেবিলের একাধিক রো-এর সাথে যুক্ত থাকে। উদাহরণ: `products` এবং `product_details` টেবিল।

3. **Many-to-Many**: দুটি টেবিলের মধ্যে অনেকগুলো রো একে অপরের সাথে সম্পর্কযুক্ত থাকে। উদাহরণ: `products` এবং `categories` (পিভট টেবিলের মাধ্যমে)।

### Laravel এ Relationship Constraints

Laravel ডাটাবেইজ ম্যানেজমেন্টে Relationship Constraint দিয়ে ডেটার সঠিক কনসিসটেন্সি নিশ্চিত করা হয়। এর মধ্যে সবচেয়ে প্রচলিত কনস্ট্রেইন্টগুলো হলো `cascade` এবং `restrict`। এগুলো মাইগ্রেশন ফাইলে ব্যবহার করা হয় যাতে ডাটার ইনকনসিসটেন্সি এড়ানো যায়।

**কিছু কনস্ট্রেইন্টের উদাহরণ:**

| Method                       | Description                                   |
| ---------------------------- | --------------------------------------------- |
| `$table->cascadeOnUpdate()`  | আপডেট করলে সম্পর্কিত চাইল্ড রেকর্ডও আপডেট হবে |
| `$table->restrictOnUpdate()` | আপডেট রেস্ট্রিক্ট করা হবে                     |
| `$table->cascadeOnDelete()`  | ডিলিট করলে সম্পর্কিত চাইল্ড রেকর্ডও ডিলিট হবে |
| `$table->restrictOnDelete()` | ডিলিট রেস্ট্রিক্ট করা হবে                     |
| `$table->nullOnDelete()`     | ডিলিট করলে ফরেন কী নাল হয়ে যাবে               |

#### Cascade কনস্ট্রেইন্ট:

**CascadeOnDelete:** যদি আমরা প্যারেন্ট টেবিলের একটি রেকর্ড ডিলিট করি, তবে এর সাথে সম্পর্কিত চাইল্ড টেবিলের রেকর্ডও ডিলিট হবে। উদাহরণস্বরূপ, `products` টেবিলের রেকর্ড ডিলিট হলে, `product_details` টেবিলের সাথে সম্পর্কিত সব ডাটা ডিলিট হবে।  
**CascadeOnUpdate:** প্যারেন্ট টেবিল আপডেট করলে চাইল্ড টেবিলের ফরেন কী রিলেটেড রেকর্ডও আপডেট হবে। যেমন, `users` টেবিলের ইমেইল আপডেট করলে `profiles` টেবিলের ইমেইলও আপডেট হবে, যাতে ইনকনসিসটেন্সি না হয়।

#### Restrict কনস্ট্রেইন্ট:

**RestrictOnDelete:** চাইল্ড টেবিলের রেকর্ড ডিলিট না করা পর্যন্ত প্যারেন্ট টেবিলের রেকর্ড ডিলিট করা যাবে না। যেমন, `product_details` টেবিল থেকে প্রথমে ডেটা ডিলিট করতে হবে, তারপর `products` টেবিল থেকে ডেটা ডিলিট করা যাবে।
**RestrictOnUpdate:** একইভাবে, চাইল্ড টেবিল আপডেট না করলে প্যারেন্ট টেবিল আপডেট করা যাবে না।

#### Null On Delete:

`nullOnDelete()` কনস্ট্রেইন্ট ব্যবহার করলে, প্যারেন্ট রেকর্ড ডিলিট হলে চাইল্ড টেবিলের ফরেন কী নাল হয়ে যাবে। সাধারণত এটি অনেক সময় ব্যবহার হয় না, তবে নির্দিষ্ট ক্ষেত্রে প্রয়োজন হতে পারে।

### Relationship Constraints এর ব্যবহার

**ইনকনসিসটেন্সি প্রতিরোধে**  
ডাটাবেইজে রিলেশনশিপ তৈরি করার সময় কনসিসটেন্সি বজায় রাখা খুবই গুরুত্বপূর্ণ। উদাহরণ হিসেবে বলা যায়, যদি `profiles` টেবিলের ডাটা থাকে, কিন্তু `users` টেবিলে সেই ডাটা না থাকে, তাহলে সেই প্রোফাইলের কোনো মূল্য থাকবে না। একইভাবে, `products` এবং `product_details` টেবিলেও ইনকনসিসটেন্সি হতে পারে যদি রিলেশনশিপ কনস্ট্রেইন্ট ঠিক মতো সেট করা না হয়। ইনভেন্টরি ম্যানেজমেন্ট সিস্টেমের ক্ষেত্রে এমন ইনকনসিসটেন্সি ডাটা ভুল ক্যালকুলেশন এবং সিস্টেমের কার্যকারিতা নষ্ট করতে পারে।

Laravel এর Relationship Constraints ব্যবহার করে এই ধরনের সমস্যা থেকে সহজেই মুক্তি পাওয়া যায়। `cascadeOnDelete()` দিয়ে প্যারেন্ট ডিলিট হলে চাইল্ড রেকর্ডও ডিলিট হবে, ফলে ম্যানুয়ালি সব রেকর্ড ডিলিট করার প্রয়োজন নেই। একইভাবে, `restrictOnDelete()` এর মাধ্যমে চাইল্ড রেকর্ড ডিলিট না করলে প্যারেন্ট ডিলিট করা যাবে না।

### সঠিক ডাটাবেইজ ডিজাইন নিশ্চিত করতে:

ডাটাবেইজে টেবিল তৈরির সময় রিলেশনশিপ এবং কনস্ট্রেইন্ট সেট করা অনেক বেশি কার্যকরী। Laravel এর মাইগ্রেশন সিস্টেম এবং Relationship Constraints এর সাহায্যে আমরা একটি সুনির্দিষ্ট এবং সিস্টেমেটিক ডাটাবেইজ ডিজাইন তৈরি করতে পারি।

এভাবে আপনার আলোচনা সুন্দরভাবে সাজানো এবং প্রয়োজনীয় টপিকের আলোচনা করা হলো।

---

# Old

এর আগে আমরা ডাটাবেইজ রিলেশনশিপ এর ভিভিন্ন সাইন সম্পর্কে জেনেছি। যেমন ওয়ান টু ওয়ান এ কেমন হয় ওয়ান টু মেনি তে কেমন হয় ইত্যাদি। যখন আমরা একটি ডাটাবেইজ ডিজাইন করবো অর্থাৎ entity relationship diagram তৈরি করবো তখন অবশ্যই আমরা সেই চিহ্ন গুলো ভালোভাবে ব্যবহার করবো। এতে করে কোন ডেটাবেইজ এর টেবিল এর সাথে কোন টেবিলের কি রিলেশন শিপ আছে না আছে সব ডেফিনেশন আমরা সহজে বুঝতে পারবো। যখন আমরা একজন ডেভেলপার হিসেবে যখন আমরা রিলেশন শিপ ভালো ভাবে বুঝতে পারবো তখন আমাদের মাথায় পুরো ক্লিয়ার ভিষন চলে আসবে ডাটাবেইজ টা কিভাবে তৈরি করতে হবে কার সাথে কার রিলেশনশিপ থাকবে ডাটা কোথায় থেকে কোথায় যাবে না যাবে সব সিদ্ধান্ত আমরা entity relationship diagram থেকে আমরা নিতে পারবো। তাই এটা ধরেই আমরা লারাভেল এ মাইগ্রেশন চালাবো শুধু যে এটা নয় এটা দিয়ে আমরা যেখানে যেখানে যা যা প্রাইমারি কি আছে সেটা একই রকম তৈরে করবো যেখানে পরেন কি দেওয়া আছে তা মেনেজ করতে পারবো এই মাইগ্রেশন ফাইল দিয়েই। আমরা যখন শুধু টেবিল তৈরি করছি তখন কিন্তু রিলেশনশিপ ফরেনকি এই বিষয় গুলো নিয়ে আমাদের চিন্তা করতে হয় না । কিন্তু আমরা তো একটি টেবিল নিয়ে কাজ করবো না আমাদের অনেক গুলো টেবিল নিয়ে কাজ করতে হয় যা বিভিন্ন রিলেশনে সংযুক্ত থাকে। আর রিলেশনশিপ ডাটাবেইজে যদি ঠিক মতো রিলেশনশিপ তৈরি করা না হয় তবে ডেটা ইনকনসিসটেনসি তৈরি হবে। ডেটা ইনকনসিসটেনসি যাতে তৈরি না হয় এর জন্য লারাভেল মাইগ্রেশন এর ভেতর বেশ কিছু Relationship Constraint দেওয়া আছে। যেমন একটি হচ্ছে cascade আর একটি হচ্ছে restrict ।

| Method                     | Description                                      |
| -------------------------- | ------------------------------------------------ |
| $table->cascadeOnUpdate()  | Updates should cascade                           |
| $table->restrictOnUpdate() | Updates should restricted                        |
| $table->cascadeOnDelete()  | Deletes should cascade                           |
| $table->restrictOnDelete() | Delete should restricted                         |
| $table->nullOnDelete()     | Deletes should set the foreign key value to null |

আচ্ছা রিলেশন শিপ কনট্রেন্ট বলতে আমরা কি বুঝি । আমরা যদি রিলেশন শিপ কনট্রেন্ট প্রেকটিক্যাল এক্সজাম্পল দিয়ে বুঝার চেষ্টা করি আমরা যে ইআর ডায়াগ্রামটি দেখছি তার অনেকগুলো টেবিল আছে যেমন একটি টেবিল আছে users সেই users এর ডিটেইল আবার আছে profiles টেবিলে। এখন আমরা যদি users কে পেরেন্ট টেবিল ধরি এবং profiles কে চাইল্ড টেবিল ধরি তবে users এর একটি রো users টেবিলে আছে আর সেই রো এর সাথে রিলেশনশিপ এ সেই ইউজার এর প্রোফাইল এর ডিটেইল টা আমার profiles টেবিলে থাকবে। এখন যদি এমন কোন ঘনটা ঘটে যে আমার profiles টেবিলে ডাটা আছে কিন্তু ইউজার্স টেবিলে ডাটা নাই তবে সেই প্রোফাইল এর তথ্য আমাদের কোনই কাজে লাগবে না কারণ সেই ফোইল টা কোন ইউজার এর সেই ্ইউজার টাই আমার নাই এখানেই তৈরি হবে ইনকনসিসটেনসি। আবার যদি উলটো টি হয় তখন ও ইনকনসিসটেনসি তৈরি হবে। একই ভাবে আমরা লক্ষ্য করলে products ও product_details এর মাঝে ও একই ঘটনা লক্ষ্য করবো। এই ভাবে ডাটা ইনকনসিসটেনসি এর পাশাপাশি আমাদের প্রচুর গারবেজ ডাটা তৈরি হবে । এই রকম কিছু যদি ট্যানজেকশনাল বিষয়ে ঘটে তবে (ট্যানজেকশনাল বিষয়ে মানে ধরুন আমরা একটি সপ্টওয়্যার তৈরি করছি সেখানে আমার সেলস মেনেজম্যান্ট আছে সেখানে আমার পারচেইজ মেনেজম্যান্ট আছে সেখানে আমার এক্সপেন্স মেনেজম্যান্ট আছে সেখানে যদি ইনকনসিসটেনসি তৈরি হয় তবে আমার সফটওয়্যার কিন্তু ভুল ক্যালকুলেশন দিবে। এভাবে কল্পনা করুন কোন একটি ইনভেনটরি মেনেজম্যান্ট সিস্টেমে তার সেল্স হিস্টরি আছে কিন্তু সেই সেলসটি কোন কাস্টমারের কাছে করেছে কাস্টমার এর ডিটেইল সে হারিয়ে ফেলেছে বা নাই তবে সেই রেকড এর কোনই দাম নেই। )। তো আমরা যতই ভালো সপ্টওয়্যার বানাই না কেন যদি এমন কোন সমস্যা থাকে তবে আমাদের কত ক্ষতি হবে তা কল্পনার ও অতীত। লারাভল এ এই বিষয়গুলো ম্যানটেন করার জন্য ই আমরা Relationship Constraint ব্যবহার করি। এর একটি হচ্ছে cascade আর একটি হচ্ছে restrict এবং। এই cascade এর অর্থ কি অর্থ হচ্ছে একটি হলে আর একটি হতেই হবে। আর restrict অর্থ আগের টা না হলে পরের টা হতে দিবো না। উদাহরন সরুপ আমাদের এখানে প্রোডাক্ট ও প্রোডাক্টডিটেইলস এর মাঝখানে একটি cascade কনস্ট্রান্ট তৈরি করি। সেক্ষেত্রে প্রোডাক্ট ডিলেট হয়ে গেলে প্রোডাক্ট এর সাথে যেহুতু ডিটেইলস এসোসিয়েটেড তাই এটিও ডিলেট হয়ে যাবে। cascadeOnDelete এর অর্থ হচ্ছে প্যারেন্ট এর সাথে যতো গুলো রিলেটেড চাইল্ড আছে সেগুলোও অটোমেটিক্যালি ডিলিট হয়ে যাবে আমাদের ম্যানুয়ালি ধরে ধরে আর ডিলেট করতে হবে না। একই ভাবে users এবং profiles টেবিলেও একই ঘটনা cascadeOnDelete ব্যবহার করলে কোনভাবে একট টেবিলের ডাটা ডিলিট হলে অন্যটির ও ডিলিট হয়ে যাবে। cascadeOnDelete এর মতো cascadeOnUpdate এর বিষয় লক্ষ্য করুন এখানে যদি আমারা একটি টেবিল আপডেইট করি তবে উদাহরণ সরুপ ধরুন users এর ইমেইল এডড্রেস এখন যদি এটি ফরেন কি হিসেবে অন্য টেবিলে থাকে তবে নিশ্চয় আমাকে সেই টেবিল টিও চেঞ্জ করতে হবে। কারন ধরুন users টেবিলে আমাই কোন ইউজার এর ইমেইল আপডেইট হলো কিন্তু প্রোফাইল টেবিলে আপডেইট হলো না তবে তা ইউজার এর ফ্রোফাইল ইউজার আর খুজেই পাবে না। অর্থাৎ আপডেইট করলে দুটকেই করতে হবে। এই পরিস্থিতি তৈরি করার জন্য আমরা লারাভেল এর এই cascadeOnUpdate() যদি ডাটাবেইজে ইমপ্লিমেন্ট করি তবে একটির ফরেন কি আপডেইট হলে একা একাই বাকি গুলোও অটো আপডেইট হয়ে যাবে। কিন্তু যদি আমরা নিজে নিজে এই সকল কাজ করতে চাই তবে এটি খুবই কঠিন কারন একটি টেবিলের সাথে কত কত টেবিলের সাথে রিলেশন থাকবে তা খুজে খুজে বের করাই তো কঠিন। cascade এর পর এবার আমরা বুঝার চেষ্টা করবো restrict এখানে restrictOnDelete() এর মানে হচ্ছে ডিলিট যদি আমাদের করতেই হয় তবে চাইল্ড লেয়ার থেকে ডিলিট করতে করতে প্যারেন্ট পর্যন্ত আসেতে হবে শুরুতেই প্যরেন্ট থেকে ডিলিট করা যাবে না। আমাদের আগের উদাহরণে ফিরে যাই আমাদের products টেবিরের চাইল্ড হচ্ছে product_details তো এখানে আমরা চাইলেই products এর ডাটা ডিলিট করতে পারবো না আমাদের আগে product_details থেকে তথ্য ডিলিট করতে হবে পরে products থেকে ডিলিট করতে হবে এটিই হচ্ছে restrictOnDelete()। একই ভাবে restrictOnUpdate() এ বেলায় আগে চাইলন্ড এ আপডেইট করে তারপর প্যারেন্ট আপডেইট করতে হবে। অর্থাৎ আমরা cascade এ আমরা যে সুবিধা পাই restrict এ তার অপজিট । আমরা সাধারণত অধিকাংশ সময় cascadeOnUpdate() আপডেইট এর জন্য ব্যবহার করি বেশি আর ডিলিট এর বেলায় restrictOnDelete() ব্যবহার করি। আর একটি সাধারণত ব্যবহার না হলেও মাইগ্রেশন আছে nullOnDelete() অর্থাৎ ডিলিট হলে সেটা ন্যাল হয়ে থাকেবে। আমরা যখন লারাভেল মাইগ্রেশন ব্যবহার করে ডাটাবেইজ টেবিল গুলো ইআর ডায়াগ্রাম মেনটেন করে তৈরি করবো তখন অবশ্যই আমরা এই রিলেশন শিপ গুলো মেনটেন করবো পাশাপাশি রিলেশনশিপ কনস্ট্রেন্ট গুলো অবশ্যই ব্যবহার করবো।
![alt text](image-3.png)
