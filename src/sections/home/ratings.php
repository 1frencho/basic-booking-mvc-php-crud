<?php
$reviews = [
  [
    "name" => "John Smith",
    "role" => "Travel Blogger",
    "avatar" => "https://i.pravatar.cc/100?img=1",
    "rating" => 5,
    "text" => "Booking.com made planning my vacation seamless. Their intuitive interface and variety of options are unmatched!"
  ],
  [
    "name" => "Emily Johnson",
    "role" => "Frequent Traveler",
    "avatar" => "https://i.pravatar.cc/100?img=2",
    "rating" => 4,
    "text" => "Great experience overall! Booking was fast, and the customer support is responsive."
  ],
  [
    "name" => "Michael Lee",
    "role" => "Photographer",
    "avatar" => "https://i.pravatar.cc/100?img=3",
    "rating" => 5,
    "text" => "I loved how I could filter through accommodations to find exactly what I needed for my shoot."
  ],
  [
    "name" => "Sophia Brown",
    "role" => "Vacation Planner",
    "avatar" => "https://i.pravatar.cc/100?img=4",
    "rating" => 4,
    "text" => "Good selection of properties, though some listings lacked detailed descriptions."
  ],
  [
    "name" => "Daniel Wilson",
    "role" => "Solo Traveler",
    "avatar" => "https://i.pravatar.cc/100?img=5",
    "rating" => 5,
    "text" => "The mobile app is excellent for last-minute bookings. Highly recommend for spontaneous trips!"
  ]
];
?>

<section class="flex flex-col items-center justify-center px-4 gap-4 md:px-8 py-4 md:py-8 h-full">
  <h4
    class="flex items-center gap-2 text-base font-semibold text-gray-900 capitalize transition-all duration-500 self-start">
    Platform Ratings
  </h4>
  <!-- Divider -->
  <div class="w-full h-1 bg-cyan-400 rounded-full"></div>

  <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 items-center justify-center w-full ">
    <?php foreach ($reviews as $review): ?>
      <div
        class="group bg-white border border-solid  border-gray-300 rounded-2xl p-6 transition-all duration-500 w-96 hover:border-cyan-600">
        <div class="flex items-center gap-5 mb-6">
          <img src="<?= htmlspecialchars($review['avatar']) ?>" alt="<?= htmlspecialchars($review['name']) ?> avatar"
            class="w-12 h-12 rounded-full">
          <div class="grid gap-1">
            <h5 class="text-gray-900 font-medium transition-all duration-500"><?= htmlspecialchars($review['name']) ?>
            </h5>
            <span class="text-sm leading-6 text-gray-500"><?= htmlspecialchars($review['role']) ?></span>
          </div>
        </div>
        <div class="flex items-center mb-6 gap-2 text-amber-500 transition-all duration-500">
          <?php for ($i = 0; $i < $review['rating']; $i++): ?>
            <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                fill="currentColor"></path>
            </svg>
          <?php endfor; ?>
        </div>
        <p class="text-sm text-gray-500 leading-6 transition-all duration-500 group-hover:text-gray-800">
          <?= htmlspecialchars($review['text']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>