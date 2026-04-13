<?php

namespace App\Controller\Admin;

use App\Database\Mysql;
use App\Repository\SaturdayRepository;
use App\Utils\Auth;
use App\Utils\Csrf;

class AdminSaturdayController
{
    public function __construct() {}

    public function index(): void
    {
        Auth::requireAdmin();

        $pdo = Mysql::connectBdd();
        $repository = new SaturdayRepository($pdo);
        $saturdays = $repository->findAll();

        include __DIR__ . '/../../../template/admin/saturday/index.php';
    }

    public function create(): void
    {
        Auth::requireAdmin();

        $errors = [];
        $old = [
            'date_saturday' => '',
            'title_saturday' => '',
            'description_saturday' => '',
            'price_saturday' => '',
        ];

        include __DIR__ . '/../../../template/admin/saturday/create.php';
    }

    private function handleUpload(?string $currentImage = null): array
    {
        $errors = [];
        $imagePath = $currentImage;

        if (isset($_FILES['image_saturday']) && $_FILES['image_saturday']['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($_FILES['image_saturday']['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Erreur lors de l’upload de l’image.';
            } else {
                $imageInfo = getimagesize($_FILES['image_saturday']['tmp_name']);

                if ($imageInfo === false) {
                    $errors[] = 'Le fichier envoyé n’est pas une image valide.';
                } else {
                    $originalName = $_FILES['image_saturday']['name'];
                    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                    if (!in_array($extension, $allowedExtensions, true)) {
                        $errors[] = 'Le format de l’image doit être JPG, PNG ou WEBP.';
                    } else {
                        $extension = $extension === 'jpeg' ? '.jpg' : '.' . $extension;

                        $fileName = 'saturday_' . date('Ymd_His') . '_' . bin2hex(random_bytes(6)) . $extension;
                        $uploadDirectory = dirname(__DIR__, 3) . '/public/assets/images/plat_samedi/';

                        if (!is_dir($uploadDirectory)) {
                            mkdir($uploadDirectory, 0775, true);
                        }

                        $destination = $uploadDirectory . $fileName;

                        if (!move_uploaded_file($_FILES['image_saturday']['tmp_name'], $destination)) {
                            $errors[] = 'Impossible d’enregistrer l’image uploadée.';
                        } else {
                            $imagePath = '/assets/images/plat_samedi/' . $fileName;
                        }
                    }
                }
            }
        }

        return [$imagePath, $errors];
    }

    private function deleteImageFile(?string $imagePath): void
    {
        if (empty($imagePath)) {
            return;
        }

        $relativePath = ltrim($imagePath, '/');
        $fullPath = dirname(__DIR__, 3) . '/public/' . $relativePath;

        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    public function store(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/saturday/create');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $dateSaturday = trim($_POST['date_saturday'] ?? '');
        $titleSaturday = trim($_POST['title_saturday'] ?? '');
        $descriptionSaturday = trim($_POST['description_saturday'] ?? '');
        $priceSaturday = trim($_POST['price_saturday'] ?? '');

        $errors = [];
        $old = [
            'date_saturday' => $dateSaturday,
            'title_saturday' => $titleSaturday,
            'description_saturday' => $descriptionSaturday,
            'price_saturday' => $priceSaturday,
        ];

        if ($dateSaturday === '') {
            $errors[] = 'La date du plat du samedi est obligatoire.';
        }

        if ($titleSaturday === '') {
            $errors[] = 'Le titre du plat du samedi est obligatoire.';
        }

        if ($priceSaturday === '' || !is_numeric($priceSaturday)) {
            $errors[] = 'Le prix doit être un nombre valide.';
        }

        [$imagePath, $uploadErrors] = $this->handleUpload();
        $errors = array_merge($errors, $uploadErrors);

        if (!empty($errors)) {
            include __DIR__ . '/../../../template/admin/saturday/create.php';
            return;
        }

        $pdo = Mysql::connectBdd();
        $repository = new SaturdayRepository($pdo);

        $administratorId = isset($_SESSION['admin']['id_administrator'])
            ? (int) $_SESSION['admin']['id_administrator']
            : null;

        $repository->insert(
            $dateSaturday,
            $imagePath,
            $titleSaturday,
            $descriptionSaturday !== '' ? $descriptionSaturday : null,
            (float) $priceSaturday,
            $administratorId
        );

        header('Location: /admin/saturday');
        exit;
    }

    public function edit(): void
    {
        Auth::requireAdmin();

        $idSaturday = (int) ($_GET['id'] ?? 0);

        if ($idSaturday <= 0) {
            header('Location: /admin/saturday');
            exit;
        }

        $pdo = Mysql::connectBdd();
        $repository = new SaturdayRepository($pdo);
        $saturday = $repository->findById($idSaturday);

        if (!$saturday) {
            header('Location: /admin/saturday');
            exit;
        }

        $errors = [];
        $old = $saturday;

        include __DIR__ . '/../../../template/admin/saturday/edit.php';
    }

    public function update(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/saturday');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $idSaturday = (int) ($_POST['id_saturday'] ?? 0);

        $pdo = Mysql::connectBdd();
        $repository = new SaturdayRepository($pdo);
        $saturday = $repository->findById($idSaturday);

        if (!$saturday) {
            header('Location: /admin/saturday');
            exit;
        }

        $dateSaturday = trim($_POST['date_saturday'] ?? '');
        $titleSaturday = trim($_POST['title_saturday'] ?? '');
        $descriptionSaturday = trim($_POST['description_saturday'] ?? '');
        $priceSaturday = trim($_POST['price_saturday'] ?? '');

        $errors = [];
        $old = [
            'id_saturday' => $idSaturday,
            'date_saturday' => $dateSaturday,
            'title_saturday' => $titleSaturday,
            'description_saturday' => $descriptionSaturday,
            'price_saturday' => $priceSaturday,
            'image_saturday' => $saturday['image_saturday'],
        ];

        if ($dateSaturday === '') {
            $errors[] = 'La date du plat du samedi est obligatoire.';
        }

        if ($titleSaturday === '') {
            $errors[] = 'Le titre du plat du samedi est obligatoire.';
        }

        if ($priceSaturday === '' || !is_numeric($priceSaturday)) {
            $errors[] = 'Le prix doit être un nombre valide.';
        }

        [$imagePath, $uploadErrors] = $this->handleUpload($saturday['image_saturday']);
        $errors = array_merge($errors, $uploadErrors);

        if (!empty($errors)) {
            include __DIR__ . '/../../../template/admin/saturday/edit.php';
            return;
        }

        if ($imagePath !== $saturday['image_saturday'] && !empty($saturday['image_saturday'])) {
            $this->deleteImageFile($saturday['image_saturday']);
        }

        $repository->update(
            $idSaturday,
            $dateSaturday,
            $imagePath,
            $titleSaturday,
            $descriptionSaturday !== '' ? $descriptionSaturday : null,
            (float) $priceSaturday
        );

        header('Location: /admin/saturday');
        exit;
    }

    public function delete(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/saturday');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $idSaturday = (int) ($_POST['id_saturday'] ?? 0);

        if ($idSaturday <= 0) {
            header('Location: /admin/saturday');
            exit;
        }

        $pdo = Mysql::connectBdd();
        $repository = new SaturdayRepository($pdo);
        $saturday = $repository->findById($idSaturday);

        if ($saturday) {
            if (!empty($saturday['image_saturday'])) {
                $this->deleteImageFile($saturday['image_saturday']);
            }

            $repository->delete($idSaturday);
        }

        header('Location: /admin/saturday');
        exit;
    }
}
