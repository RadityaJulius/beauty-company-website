<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File Editor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .editor {
            font-family: "Fira Code", monospace;
            background-color: #1e1e1e;
            color: #d4d4d4;
            line-height: 1.5;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow: auto;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-200 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center">PHP Code Editor</h1>

        <?php
        $file = 'admin.php';
        $backupFile = 'admin_backup.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // If saving changes, create a backup before overwriting
            if (isset($_POST['content'])) {
                copy($file, $backupFile); // Backup the current file
                file_put_contents($file, $_POST['content']);
                echo '<p class="text-green-400 text-center mb-4">File saved successfully!</p>';
            }

            // If undoing, restore the backup
            if (isset($_POST['undo'])) {
                if (file_exists($backupFile)) {
                    copy($backupFile, $file);
                    echo '<p class="text-yellow-400 text-center mb-4">Changes undone successfully!</p>';
                } else {
                    echo '<p class="text-red-400 text-center mb-4">No backup available to undo.</p>';
                }
            }
        }

        $content = file_get_contents($file);
        ?>

        <form method="POST" class="bg-gray-800 p-4 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Edit Code:</label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="20" 
                    class="editor w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                ><?php echo htmlspecialchars($content); ?></textarea>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white py-2 px-4 rounded">
                    Save Changes
                </button>
                <button 
                    type="submit" 
                    name="undo" 
                    value="1" 
                    class="bg-red-600 hover:bg-red-500 text-white py-2 px-4 rounded"
                >
                    Undo
                </button>
            </div>
        </form>
    </div>
</body>
</html>
