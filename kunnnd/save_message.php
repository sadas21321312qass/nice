<?php
// Устанавливаем заголовки для обработки CORS (если необходимо)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Проверяем, была ли отправлена POST-запрос
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем сообщение из POST-запроса
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['message'])) {
        $message = $data['message'];

        // Сохраняем сообщение в messages.txt
        file_put_contents('messages.txt', $message . PHP_EOL, FILE_APPEND | LOCK_EX);

        // Возвращаем успешный ответ
        echo json_encode(['status' => 'success', 'message' => 'Сообщение сохранено.']);
    } else {
        // Возвращаем ошибку, если сообщение не указано
        echo json_encode(['status' => 'error', 'message' => 'Сообщение не указано.']);
    }
} else {
    // Если это не POST-запрос, возвращаем ошибку
    echo json_encode(['status' => 'error', 'message' => 'Неверный метод запроса.']);
}
?>
