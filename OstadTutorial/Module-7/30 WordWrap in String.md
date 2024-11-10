PHP এর wordwrap() ফাংশন
wordwrap() ফাংশনটি PHP-এ একটি খুবই দরকারী স্ট্রিং ম্যানিপুলেশন ফাংশন। এটি একটি দীর্ঘ স্ট্রিংকে নির্দিষ্ট সংখ্যক অক্ষরের পরে ভেঙে নতুন লাইনে প্রিন্ট করার কাজ করে। এটি সাধারণত টেক্সটকে একটি নির্দিষ্ট প্রস্থের কলামে ফিট করানোর জন্য ব্যবহৃত হয়, যেমন একটি ওয়েব পেজে একটি টেক্সট এলাকা।
```php
wordwrap(string $str, int $width = 75, string $break = "\n", bool $cut = false)
```
$str: যে স্ট্রিংকে ভাগ করতে চান, সেটি।
$width: প্রতিটি লাইনে সর্বোচ্চ কতগুলো অক্ষর থাকবে, সেটি। ডিফল্ট মান 75।
$break: নতুন লাইনে যে চরিত্রটি ব্যবহার করা হবে, সেটি। ডিফল্ট মান "\n" (নতুন লাইন)।
$cut: যদি একটি শব্দ $width এর চেয়ে বড় হয়, তাহলে শব্দটিকে ভাগ করে নতুন লাইনে নেওয়া হবে কি না, সেটি নির্দেশ করে। ডিফল্ট মান false।

```php
$long_text = "এটি একটি দীর্ঘ টেক্সট যা আমরা নির্দিষ্ট সংখ্যক অক্ষরের পরে ভাগ করতে চাই।";
$wrapped_text = wordwrap($long_text, 30);
echo $wrapped_text;
```

উপরের কোডটি নিম্নলিখিত আউটপুট দেবে:

এটি একটি দীর্ঘ টেক্সট যা আমরা
নির্দিষ্ট সংখ্যক অক্ষরের পরে
ভাগ করতে চাই।

কেন wordwrap() ব্যবহার করা হয়?
টেক্সট ফরম্যাটিং: টেক্সটকে একটি নির্দিষ্ট প্রস্থের কলামে ফিট করানোর জন্য।
ইমেইল: ইমেইলের বডি টেক্সটকে নির্দিষ্ট সংখ্যক অক্ষরের পরে ভাগ করে পাঠানোর জন্য।
রিপোর্টিং: রিপোর্ট তৈরি করার সময় ডাটাকে সুন্দরভাবে ফরম্যাট করার জন্য।

আরো কিছু বিষয়
cut প্যারামিটার: যদি cut প্যারামিটার true হয়, তাহলে একটি শব্দ যদি $width এর চেয়ে বড় হয়, তাহলে শব্দটিকে ভাগ করে নতুন লাইনে নেওয়া হবে।
UTF-8 সাপোর্ট: PHP 5.4 থেকে wordwrap() ফাংশন UTF-8 এনকোডিং সাপোর্ট করে।
অন্যান্য ফাংশনের সাথে ব্যবহার: wordwrap() ফাংশনকে অন্যান্য স্ট্রিং ম্যানিপুলেশন ফাংশনের সাথে মিলিয়ে ব্যবহার করে আরো জটিল কাজ করা যায়।

wordwrap() এর সীমাবদ্ধতা
একটি শব্দকে ভাগ করা: যদি একটি শব্দ নির্দিষ্ট প্রস্থের চেয়ে বড় হয় এবং cut প্যারামিটার false হয়, তাহলে সম্পূর্ণ শব্দটি পরের লাইনে চলে যাবে।
বিভিন্ন ফন্ট এবং ক্যারেক্টার: বিভিন্ন ফন্ট এবং ক্যারেক্টারের প্রস্থ ভিন্ন হতে পারে, ফলে সঠিকভাবে টেক্সটকে ভাগ করা কঠিন হতে পারে।

wordwrap() ফাংশনটি একটি শক্তিশালী টুল, যা অন্য ফাংশনগুলোর সাথে মিলেমিশে আরো জটিল এবং কার্যকরী টেক্সট ম্যানিপুলেশন সমাধান তৈরি করতে পারে। আসুন দেখি কীভাবে wordwrap() ফাংশনকে অন্য কিছু সাধারণ ফাংশনের সাথে কম্বাইন করা যায়:

1. wordwrap() এবং explode() এর সমন্বয়:
একটি স্ট্রিংকে কমা বা অন্য কোনো বিভাজক দিয়ে ভাগ করে আলাদা আলাদা শব্দ বা বাক্যে পরিণত করার জন্য explode() ফাংশন ব্যবহার করা হয়। এরপর প্রতিটি শব্দ বা বাক্যকে wordwrap() ফাংশন ব্যবহার করে নির্দিষ্ট প্রস্থের মধ্যে ফিট করা যায়।

```php
$long_text = "এটি একটি দীর্ঘ টেক্সট, যা আমরা কমা দিয়ে ভাগ করব এবং তারপর প্রতিটি অংশকে আলাদা লাইনে প্রিন্ট করব।";
$parts = explode(",", $long_text);
foreach ($parts as $part) {
  echo wordwrap($part, 30) . "\n";
}
```

2. wordwrap() এবং array_map() এর সমন্বয়:
array_map() ফাংশন একটি অ্যারের প্রতিটি এলিমেন্টের উপর একটি নির্দিষ্ট ফাংশন প্রয়োগ করতে ব্যবহৃত হয়। এখানে আমরা array_map() এর সাথে wordwrap() ব্যবহার করে একটি অ্যারের সকল এলিমেন্টকে একসাথে ফরম্যাট করতে পারি।

```php
$texts = ["এটি একটি দীর্ঘ টেক্সট", "আর একটি দীর্ঘ টেক্সট"];
$wrapped_texts = array_map('wordwrap', $texts, array_fill(0, count($texts), 30));
print_r($wrapped_texts);
```
3. wordwrap() এবং nl2br() এর সমন্বয়:
nl2br() ফাংশন একটি স্ট্রিং-এর মধ্যে থাকা নতুন লাইন চরিত্রগুলোকে <br> ট্যাগে রূপান্তর করে। wordwrap() দিয়ে স্ট্রিংকে ভাগ করার পর nl2br() ব্যবহার করে এই ভাগ করা টেক্সটকে HTML ফরম্যাটে প্রিন্ট করা যায়।
```php
$text = "এটি একটি দীর্ঘ টেক্সট\nযা আমরা ভাগ করব";
$wrapped_text = wordwrap($text, 30);
$html_text = nl2br($wrapped_text);
echo $html_text;
```

4. wordwrap() এবং ফাইল হ্যান্ডলিং:
একটি ফাইল থেকে টেক্সট পড়ে, wordwrap() ব্যবহার করে ফরম্যাট করে এবং আবার অন্য একটি ফাইলে লিখতে এই ফাংশনগুলো ব্যবহার করা যায়।

```php
$file = fopen("long_text.txt", "r");
while (!feof($file)) {
  $line = fgets($file);
  echo wordwrap($line, 30) . "\n";
}
fclose($file);
```

wordwrap() ফাংশন ব্যবহার করে নির্দিষ্ট সমস্যা সমাধান
wordwrap() ফাংশনটি বিভিন্ন ধরনের সমস্যার সমাধানে ব্যবহার করা যায়। আসুন কয়েকটি উদাহরণ দেখি:

উদাহরণ ১: ইমেইল টেক্সট ফরম্যাটিং
ধরুন, আপনি একটি ইমেইল পাঠাচ্ছেন এবং ইমেইল ক্লায়েন্টের স্ক্রিনের প্রস্থের সাথে মিলিয়ে টেক্সটকে ফরম্যাট করতে চান। এখানে wordwrap() ফাংশন ব্যবহার করতে পারেন:

```php
$long_text = "এটি একটি দীর্ঘ ইমেইল টেক্সট যা আমরা নির্দিষ্ট সংখ্যক অক্ষরের পরে ভাগ করতে চাই।";
$wrapped_text = wordwrap($long_text, 70); // 70 অক্ষরের পরে ভাগ করবে
echo $wrapped_text;
```

উদাহরণ ২: SMS পাঠানো
SMS-এর ক্যারেক্টার সীমা থাকে। wordwrap() ব্যবহার করে একটি দীর্ঘ টেক্সটকে কয়েকটি ছোট SMS-এ ভাগ করা যায়:
```php
$long_message = "এটি একটি দীর্ঘ SMS যা আমরা কয়েকটি ছোট SMS-এ ভাগ করব।";
$parts = explode("\n", wordwrap($long_message, 160)); // 160 অক্ষরের পরে ভাগ করবে
foreach ($parts as $part) {
  // প্রতিটি $part একটি আলাদা SMS হিসেবে পাঠান
  send_sms($part);
}
```
উদাহরণ ৩: ওয়েব পেজের টেক্সট এলাকা
ওয়েব পেজের একটি টেক্সট এলাকাকে নির্দিষ্ট প্রস্থের মধ্যে ফিট করানোর জন্য wordwrap() ব্যবহার করা যায়।
```php
<div style="width: 400px;">
  <?php
  $text = "এটি একটি ওয়েব পেজের টেক্সট এলাকা যা আমরা নির্দিষ্ট প্রস্থের মধ্যে ফিট করাব।";
  echo wordwrap($text, 40);
  ?>
</div>
```

উদাহরণ ৪: কমান্ড লাইন আউটপুট
কমান্ড লাইনে টেক্সটকে সুন্দরভাবে প্রিন্ট করার জন্য wordwrap() ব্যবহার করা যায়:
```php
$long_command_output = "এটি একটি দীর্ঘ কমান্ডের আউটপুট যা আমরা সুন্দরভাবে ফরম্যাট করব।";
echo wordwrap($long_command_output, 80, "\n");
```
আরো কিছু ব্যবহার:
রিপোর্টিং: রিপোর্ট তৈরি করার সময় ডাটাকে সুন্দরভাবে ফরম্যাট করার জন্য।
লগ ফাইল: লগ ফাইলে টেক্সটকে সুন্দরভাবে সংরক্ষণ করার জন্য।
টেমপ্লেট ইঞ্জিন: টেমপ্লেটে ডাইনামিক ডাটা ফরম্যাট করার জন্য।
আপনার কোনো নির্দিষ্ট সমস্যা আছে যার সমাধানে wordwrap() ব্যবহার করতে চান? আমি আপনাকে আরো বিস্তারিতভাবে সাহায্য করতে পারব।

উদাহরণস্বরূপ, আপনি বলতে পারেন:

"আমি একটি ফাইল থেকে টেক্সট পড়ে তা নির্দিষ্ট প্রস্থের একটি টেক্সট এলাকায় প্রদর্শন করতে চাই।"
"আমি একটি দীর্ঘ টেক্সটকে SMS পাঠাতে চাই কিন্তু প্রতিটি SMS-এ সর্বোচ্চ 160 অক্ষর হতে হবে।"