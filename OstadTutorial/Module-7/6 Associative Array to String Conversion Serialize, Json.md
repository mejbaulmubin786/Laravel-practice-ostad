```php
<?php
$student = [
    'fname' => 'Jamal',
    'lname' => 'Ahmed',
    'age' => '15',
    'class' => 8,
    'section' => 'B',
];

echo $student['fname'] . " " . $student['lname'] . "\n"; //1st way

printf("%s %s \n", $student['fname'], $student['lname']) . "\n"; //2nd way the best way

echo join($student);  // 1st way
echo "\n";
echo join(", ", $student);//2nd way এই দুই পদ্ধতিতে যদি আমরা এরে কে স্ট্রিং এ কনভাট করি তবে তা সুন্দর মতো বুঝার উপায় নেই 
//সুন্দর মতো বুঝার মতো করতে চাইলে অন্য দুটি পদ্ধতি ব্যবহার করতে হবে। একটি হচ্ছে Json এ কনভার্ট করা সিরিয়ালাইজ করা। Json এ কনভার্ট করলে এর ইউজেবিলি বেশি।

$serialized = serialize($student);

print_r($serialized);

$newstudent = unserialize($serialized); // সিরিয়ালাইজ ডাটাকে আবার ব্যবহার উপযোগি করা
print_r($newstudent);

$jsondata = json_encode($student); // এভাবে ব্যবহার করলে জাভাস্ক্রিপ্ট সরাসরি ব্যবহার করতে পারবে। এর ব্যবহার ও বেশি।
print_r($jsondata);
$student2 = json_decode($jsondata); // পুনরায় ডাটাকে এরে তে রুপান্তর করতে হলে এই কমান্ড ব্যবহার করতে হয় তবে এই কমান্ডে যে আউটপুট পায় তা এরে না হয়ে প্রথমে Object এ রুপান্তরিত হয়। সরাসরি এরে তে রুপান্তর করতে চাইলে php কে বলে দিতে হবে সরাসরি array তে কনভার্ট করার জন্য। তার জন্য নিচের পদ্ধতি
$student2 = json_decode($jsondata, true);
print_r($student2);
```

আমরা যখনি কোন এরেতে উপরের পদ্ধতিতে ডাটা স্টোর করি তবে সেই ডাটাকে যদি আমরা পরবতির্
তে ব্যবহার করার কথা চিন্তা করি তবে আমাদের অবশ্যই সেই ডাটাকে প্রথমে স্ট্রিং এ কনভার্ট করতে হবে তা আমরা যে পদ্ধতিতেই করি না কেন। এর পর সেই স্ট্রিংটা আমরা একটি ফাইলে বা ডেটাবেসে সেইভ করে রাখতে পারি। অর্থাৎ এরেকে সরাসরি সেইভ করা সম্ভব নয় একে এই ভাবেই সেইভ করা সম্ভব।