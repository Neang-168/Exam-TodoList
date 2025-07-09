<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />      
  <title>Error</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-50 flex items-center justify-center min-h-screen">
  <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-6 text-center">
    <h1 class="text-3xl font-bold text-red-600 mb-4">⚠️ Error</h1>
    <p class="text-gray-700 mb-6">
      <?= htmlspecialchars($errorMessage) ?>
    </p>
    <a href="<?= htmlspecialchars($backLink) ?>" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
      Go Back
    </a>
  </div>
</body>
</html>
