<?php
class Categories extends Controller {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = $this->model('CategoryDAO');
    }

    public function index() {
        if (!$this->isAdmin()) {
            $this->redirectToNotFound();
        }

        $categories = $this->categoryModel->showCategories();
        $categoryCount = $this->categoryModel->countCategories();

        $this->view('admin/categories', [
            'categories' => $categories,
            'categoryCount' => $categoryCount
        ]);
    }

    public function create() {
        if (!$this->isAdmin()) {
            $this->redirectToNotFound();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCategory'])) {
            $categoryName = trim($_POST['categoryName']);
            $categoryImage = $this->handleImageUpload($_FILES['categoryImage'] ?? null);

            if (empty($categoryName)) {
                $this->handleError('Invalid Category Name', 'admin/dashboard');
                return;
            }

            $this->categoryModel->getCategory()->setName($categoryName);
            $this->categoryModel->getCategory()->setImage($categoryImage);

            if ($this->categoryModel->create($this->categoryModel->getCategory())) {
                $this->redirectToCategories();
            } else {
                $this->handleError('Failed to create category', 'admin/dashboard');
            }
        }
    }

    public function delete() {
        if (!$this->isAdmin()) {
            $this->redirectToNotFound();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteCategory'])) {
            $categoryId = (int)$_POST['categoryId'];
            $this->categoryModel->getCategory()->setId($categoryId);

            if ($this->categoryModel->delete($this->categoryModel->getCategory())) {
                $this->redirectToCategories();
            } else {
                $this->handleError('Failed to delete category', 'admin/dashboard');
            }
        }
    }

    public function edit() {
        if (!$this->isAdmin()) {
            $this->redirectToNotFound();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editCategory'])) {
            $categoryId = (int)$_POST['categoryId'];
            $categoryName = trim($_POST['categoryName']);
            $categoryImage = $this->handleImageUpload($_FILES['categoryImage'] ?? null);

            if (empty($categoryName)) {
                $this->handleError('Invalid Category Name', 'admin/dashboard');
                return;
            }

            $this->categoryModel->getCategory()->setId($categoryId);
            $this->categoryModel->getCategory()->setName($categoryName);
            $this->categoryModel->getCategory()->setImage($categoryImage);

            if ($this->categoryModel->edit($this->categoryModel->getCategory())) {
                $this->redirectToCategories();
            } else {
                $this->handleError('Failed to edit category', 'admin/dashboard');
            }
        }
    }

    public function countCategories() {
        if (!$this->isAdmin()) {
            $this->redirectToNotFound();
        }

        return $this->categoryModel->countCategories();
    }

    public function showCategories() {
        $categories = $this->categoryModel->showCategories();
        $this->view('pages/categories', ['categories' => $categories]);
    }

    // Helper Methods

    private function isAdmin(): bool {
        // Implement your admin check logic here
        return true; // Placeholder
    }

    private function redirectToNotFound() {
        header('Location: /pages/notfound');
        exit();
    }

    private function redirectToCategories() {
        header('Location: /categories');
        exit();
    }

    private function handleError(string $errorMessage, string $view) {
        $errorData = ['error_message' => $errorMessage];
        $this->view($view, $errorData);
    }

    private function handleImageUpload(?array $file): ?string {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $name = $file['name'];
        $size = $file['size'];
        $tmpName = $file['tmp_name'];
        $error = $file['error'];

        $imageName = $this->uploadImage($name, $tmpName, $size, $error);

        if (is_int($imageName)) {
            $this->handleImageUploadError($imageName);
            return null;
        }

        return $imageName;
    }

    private function uploadImage(string $name, string $tmpName, int $size, int $error): string|int {
        // Implement your image upload logic here
        // Return the image name on success, or an error code on failure
        return 'uploaded_image.jpg'; // Placeholder
    }

    private function handleImageUploadError(int $errorCode) {
        $errorMessages = [
            1 => 'Sorry, your file is too large. (max 10MB)',
            2 => 'Unsupported format. (jpg, jpeg, png, webp)',
            // Add more error codes as needed
        ];

        $errorMessage = $errorMessages[$errorCode] ?? 'Unknown error occurred';
        $this->handleError($errorMessage, 'admin/dashboard');
    }
}