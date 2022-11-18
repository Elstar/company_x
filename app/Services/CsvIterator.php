<?php

namespace App\Services;

use Exception;
use Iterator;

class CsvIterator implements Iterator
{
    const ROW_SIZE = 4096;

    protected $filePointer = null;

    protected ?array $currentElement = null;

    protected ?int $rowCounter = null;

    protected ?string $delimiter = null;

    /**
     * Конструктор пытается открыть CSV-файл. Он выдаёт исключение при ошибке.
     *
     * @param string $file CSV-файл.
     * @param string $delimiter Разделитель.
     *
     * @throws Exception
     */
    public function __construct(string $file, string $delimiter = ',')
    {
        try {
            $this->filePointer = fopen($file, 'rb');
            $this->delimiter = $delimiter;
        } catch (Exception $e) {
            throw new Exception('The file "' . $file . '" cannot be read.');
        }
    }

    /**
     * Этот метод сбрасывает указатель файла.
     */
    public function rewind(): void
    {
        $this->rowCounter = 0;
        rewind($this->filePointer);
    }

    /**
     * Этот метод возвращает текущую CSV-строку в виде двумерного массива.
     *
     * @return array Текущая CSV-строка в виде двумерного массива.
     */
    public function current(): array
    {
        $result = fgetcsv($this->filePointer, self::ROW_SIZE, $this->delimiter);
        if ($result === false) {
            $this->currentElement = [];
        } else {
            $this->currentElement = $result;
        }
        $this->rowCounter++;

        return $this->currentElement;
    }

    /**
     * Этот метод возвращает номер текущей строки.
     *
     * @return int Номер текущей строки.
     */
    public function key(): int
    {
        return $this->rowCounter;
    }

    /**
     * Этот метод проверяет, достигнут ли конец файла.
     *
     * @return bool Возвращает true при достижении EOF, в ином случае false.
     */
    public function next(): bool
    {
        if (is_resource($this->filePointer)) {
            return !feof($this->filePointer);
        }

        return false;
    }

    /**
     * Этот метод проверяет, является ли следующая строка допустимой.
     *
     * @return bool Если следующая строка является допустимой.
     */
    public function valid(): bool
    {
        if (!$this->next()) {
            if (is_resource($this->filePointer)) {
                fclose($this->filePointer);
            }

            return false;
        }

        return true;
    }
}
