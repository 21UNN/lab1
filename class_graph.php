<?php
/**
 * Graph
 * Класс конфигурирует основной граф
 * Соединения между узлами задаются рандомно
 * Входящий параметр кол-во вершин
 */
class Graph {
	//кол-во
	public $count;

	//Массив узлов
	public $nodes;

	//Массив связей
	public $options = array();

	//Массив вывода
	public $out = array();

	
	 //Конструктор класса 
	public function __construct($count = 0) {
		//Если количество пустое || проверка на число || проверка на число && кол-во < 1
		if (empty($count) || !is_numeric($count) || is_numeric($count) && $count < 1) {
			//возвращаем ложное лог. значение
			return false;
		}
		//обращение к свойству экземпляра класса
		$this->count = $count;
	}

	
	  //Функция которая заполянет массив опций
	public function сreateOptions() {
		//свойство nodes = диапазону (от 1 до кол-ва)
		$this->nodes = range(1, $this->count);
		//цикл (i = 0; пока i < кол-во ; прибавляем единицу i++)
		for ($i = 0; $i < $this->count; $i++) {
			//свойство options[$i+1] = свойству сreateСonnections($i + 1)
			$this->options[$i + 1] = $this->сreateСonnections($i + 1);
		}
		//обращение к свойству экземпляра класса
		$this->unionConnections();
		//обращение к свойству экземпляра класса
		$this->outOptions();
	}

	
	 //Функция которая заполянет массив связей с другими вершинами 
	protected function сreateСonnections($id_node) {
		$result = array();
		//переменная nodes = свойству экземляра nodes
		$nodes = $this->nodes;

		//Найдем данный узел и удалим его из массива, потому что циклических связей нет
		$key_node = array_search($id_node, $nodes);

		if ($key_node !== FALSE) {
			//удаляем элемент массива
			unset($nodes[$key_node]);

			if (!empty($nodes)) {
				//После удаления восстановим порядок ключей его
				$nodes = array_values($nodes);

				//Зададим рандомное кол-во связей между узлами, минимально 1, чтобы не было одиночного узла
				//$count_connections = rand(1, count($nodes));
				$count_connections = rand(1, min(2, count($nodes)));
				for ($i = 0; $i < $count_connections; $i++) {
					//Определим рандомный узел из массива nodes
					$rand_node = rand(0, count($nodes) - 1);

					//Добавим в массив если такого узла нет
					if (!in_array($nodes[$rand_node], $result)) {
						$result[] = $nodes[$rand_node];
					}
				}
			}
		}

		return $result;
	}

	protected function unionConnections() {
		//Произведем объединение связий
		//Конструкция foreach предоставляет простой способ перебора массивов
		foreach ($this->options as $key => $connections) {
			foreach ($connections as $value) {
				if (!in_array($key, $this->options[$value])) {
					$this->options[$value][] = $key;
				}
				//sort — Сортирует массив, SORT_NUMERIC - числовое сравнение элементов
				sort($this->options[$value], SORT_NUMERIC);
			}
		}
	}
     //Функция вывода
	protected function outOptions() {
		foreach ($this->options as $key => $connections) {
			$_connections = array();
			//удаляем знаечение
			unset($value);
			foreach ($connections as $value) {
				$_connections[] = array(
					'id' => 'item' . $value,
					'status' => true,
				);
			}
			$this->out['item' . $key] = array(
				'label' => $key,
				'weight' => rand(1, 1000), //Задаим рандомный вес узлу, в будущем будем находить максимальный
				'groups' => array(
					'group1' => $_connections,
				),
			);
		}
	}
}

?>