<?php if (!empty($layoutData['successMessage'])): ?>
  <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
    <p class="font-bold">Success</p>
    <p><?= htmlspecialchars($layoutData['successMessage']); ?></p>
  </div>
<?php endif; ?>