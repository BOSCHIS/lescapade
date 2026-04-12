<?php

namespace App\Controller\Admin;

use App\Database\Mysql;
use App\Repository\DayRepository;
use App\Utils\Auth;
use App\Utils\Csrf;

class AdminDayController
{
    public function __construct() {}

    public function index(): void
    {
        Auth::requireAdmin();

        $pdo = Mysql::connectBdd();
        $dayRepository = new DayRepository($pdo);
        $days = $dayRepository->findAll();

        include __DIR__ . '/../../../template/admin/day/index.php';
    }

    public function create(): void
    {
        Auth::requireAdmin();

        $errors = [];
        $old = [
            'date_day' => '',
            'title_day' => '',
            'description_day' => '',
            'price_day' => '',
        ];

        include __DIR__ . '/../../../template/admin/day/create.php';
    }

    private function handleUpload(?string $currentImage = null): array
    {
        $errors = [];
        $imagePath = $currentImage;

        if (isset($_FILES['image_day']) && $_FILES['image_day']['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($_FILES['image_day']['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Erreur lors de l’upload de l’image.';
            } else {
                $imageInfo = getimagesize($_FILES['image_day']['tmp_name']);

                if ($imageInfo === false) {
                    $errors[] = 'Le fichier envoyé n’est pas une image valide.';
                } else {
                    $originalName = $_FILES['image_day']['name'];
                    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                    if (!in_array($extension, $allowedExtensions, true)) {
                        $errors[] = 'Le format de l’image doit être JPG, PNG ou WEBP.';
                    } else {
                        $extension = $extension === 'jpeg' ? '.jpg' : '.' . $extension;

                        $fileName = 'day_' . date('Ymd_His') . '_' . bin2hex(random_bytes(6)) . $extension;
                        $uploadDirectory = dirname(__DIR__, 3) . '/public/assets/images/plat_jour/';

                        if (!is_dir($uploadDirectory)) {
                            mkdir($uploadDirectory, 0775, true);
                        }

                        $destination = $uploadDirectory . $fileName;

                        if (!move_uploaded_file($_FILES['image_day']['tmp_name'], $destination)) {
                            $errors[] = 'Impossible d’enregistrer l’image uploadée.';
                        } else {
                            $imagePath = '/assets/images/plat_jour/' . $fileName;
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
        $fullPath = dirname(__DIR__, 3) . '/public/' . str_replace('assets/', 'assets/', $relativePath);

        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    public function store(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/day/create');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $dateDay = trim($_POST['date_day'] ?? '');
        $titleDay = trim($_POST['title_day'] ?? '');
        $descriptionDay = trim($_POST['description_day'] ?? '');
        $priceDay = trim($_POST['price_day'] ?? '');

        $errors = [];
        $old = [
            'date_day' => $dateDay,
            'title_day' => $titleDay,
            'description_day' => $descriptionDay,
            'price_day' => $priceDay,
        ];

        if ($dateDay === '') {
            $errors[] = 'La date du plat du jour est obligatoire.';
        }

        if ($titleDay === '') {
            $errors[] = 'Le titre du plat du jour est obligatoire.';
        }

        if ($priceDay === '' || !is_numeric($priceDay)) {
            $errors[] = 'Le prix doit être un nombre valide.';
        }

        [$imagePath, $uploadErrors] = $this->handleUpload();
        $errors = array_merge($errors, $uploadErrors);

        if (!empty($errors)) {
            include __DIR__ . '/../../../template/admin/day/create.php';
            return;
        }

        $pdo = Mysql::connectBdd();
        $dayRepository = new DayRepository($pdo);

        $administratorId = isset($_SESSION['admin']['id_administrator'])
            ? (int) $_SESSION['admin']['id_administrator']
            : null;

        $dayRepository->insert(
            $dateDay,
            $imagePath,
            $titleDay,
            $descriptionDay !== '' ? $descriptionDay : null,
            (float) $priceDay,
            $administratorId
        );

        header('Location: /admin/day');
        exit;
    }

    public function edit(): void
    {
        Auth::requireAdmin();

        $idDay = (int) ($_GET['id'] ?? 0);

        if ($idDay <= 0) {
            header('Location: /admin/day');
            exit;
        }

        $pdo = Mysql::connectBdd();
        $dayRepository = new DayRepository($pdo);
        $day = $dayRepository->findById($idDay);

        if (!$day) {
            header('Location: /admin/day');
            exit;
        }

        $errors = [];
        $old = $day;

        include __DIR__ . '/../../../template/admin/day/edit.php';
    }

    public function update(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/day');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $idDay = (int) ($_POST['id_day'] ?? 0);

        $pdo = Mysql::connectBdd();
        $dayRepository = new DayRepository($pdo);
        $day = $dayRepository->findById($idDay);

        if (!$day) {
            header('Location: /admin/day');
            exit;
        }

        $dateDay = trim($_POST['date_day'] ?? '');
        $titleDay = trim($_POST['title_day'] ?? '');
        $descriptionDay = trim($_POST['description_day'] ?? '');
        $priceDay = trim($_POST['price_day'] ?? '');

        $errors = [];
        $old = [
            'id_day' => $idDay,
            'date_day' => $dateDay,
            'title_day' => $titleDay,
            'description_day' => $descriptionDay,
            'price_day' => $priceDay,
            'image_day' => $day['image_day'],
        ];

        if ($dateDay === '') {
            $errors[] = 'La date du plat du jour est obligatoire.';
        }

        if ($titleDay === '') {
            $errors[] = 'Le titre du plat du jour est obligatoire.';
        }

        if ($priceDay === '' || !is_numeric($priceDay)) {
            $errors[] = 'Le prix doit être un nombre valide.';
        }

        [$imagePath, $uploadErrors] = $this->handleUpload($day['image_day']);
        $errors = array_merge($errors, $uploadErrors);

        if (!empty($errors)) {
            include __DIR__ . '/../../../template/admin/day/edit.php';
            return;
        }

        if ($imagePath !== $day['image_day'] && !empty($day['image_day'])) {
            $this->deleteImageFile($day['image_day']);
        }

        $dayRepository->update(
            $idDay,
            $dateDay,
            $imagePath,
            $titleDay,
            $descriptionDay !== '' ? $descriptionDay : null,
            (float) $priceDay
        );

        header('Location: /admin/day');
        exit;
    }

    public function delete(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/day');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $idDay = (int) ($_POST['id_day'] ?? 0);

        if ($idDay <= 0) {
            header('Location: /admin/day');
            exit;
        }

        $pdo = Mysql::connectBdd();
        $dayRepository = new DayRepository($pdo);
        $day = $dayRepository->findById($idDay);

        if ($day) {
            if (!empty($day['image_day'])) {
                $this->deleteImageFile($day['image_day']);
            }

            $dayRepository->delete($idDay);
        }

        header('Location: /admin/day');
        exit;
    }
}
