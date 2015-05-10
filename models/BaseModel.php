<?php 
	namespace Models;
	class BaseModel {
		protected $table;
		protected $where;
		protected $columns;
		protected $limit;
		protected $dbconn;
		protected $database;
		
		function __construct( $args = array() ) {

			// echo "</br>";
			// var_dump($args);
			$args = array_merge( array(
				'table' => 'none',
				'where' => '',
				'columns' => '*',
				'limit' => 0
			), $args );
			// echo "</br>";
			// var_dump($args);
			// if ( ! isset( $args['table'] ) ) {
			// 	die( 'Table not defined. Please define a model table.' );
			// }
			// // debug_backtrace();
			extract( $args );
			
			$this->table = $table;
			$this->where = $where;
			$this->columns = $columns;
			$this->limit = $limit;

			// $db = \Services\Database::get_instance();
			// var_dump($db);
			$this->dbconn = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		}
		
		public function get( $id ) {
			$results = $this->find( array( 'where' => 'id = ' .$id ) );
			
			return $results;
		}
		public function dump_info(){
			var_dump($this->table);
			var_dump($this->where);
			var_dump($this->columns);
			var_dump($this->limit);
			var_dump($this->dbconn);
		}
		
		public function add( $pairs ) {
			// Get keys and values separately
			$keys = array_keys( $pairs );
			$values = array();
			
			// Escape values, like prepared statement
			foreach( $pairs as $key => $value ) {
				$values[] = "'" . $this->dbconn->real_escape_string( $value ) . "'";	
			}
			mysqli_report(MYSQLI_REPORT_ALL);
			
			$keys = implode( $keys, ',' );
			$values = implode( $values, ',' );
			
			$statement = $this->dbconn->prepare("insert into {$this->table}($keys) values($values)");
			
			// var_dump($query);
			$statement->execute();
			$result = $statement->get_result();
			
			// $this->dbconn->execute( $query );
			return $result;
		}
		
		public function delete( $id ) {
			$query = "DELETE FROM {$this->table} WHERE id=" . intval( $id );
			
			$this->dbconn->query( $query );
			
			return $this->dbconn->affected_rows;
		}
		
		public function update( $model ) {
			$query = "UPDATE " . $this->table . " SET ";
			
			foreach( $model as $key => $value ) {
				if( $key === 'id' ) continue;
				$query .= "$key = '" . $this->dbconn->real_escape_string( $value ) . "',"; 
			}
			$query = rtrim( $query, "," );
			$query .= " WHERE id = " . $model['id'];
			$this->dbconn->query( $query );
			
			return $this->dbconn->affected_rows;
		}
		
		public function find( $args = array() ) {
			$args = array_merge( array(
				'table' => $this->table,
				'where' => '',
				'columns' => '*',
				'limit' => 0
			), $args );
			
			extract( $args );
			
			$query = "select {$columns} from {$table}";
			
			if( ! empty( $where ) ) {
				$query .= ' where ' . $where;
			}
			
			if( ! empty( $limit ) ) {
				$query .= ' limit ' . $limit;
			}
			
	// 		var_dump($query);
			
			$result_set = $this->dbconn->query( $query );
			
			$results = $this->process_results( $result_set );
			
			return $results;
		}
		
		protected function process_results( $result_set ) {
			$results = array();
			
			if( ! empty( $result_set ) && $result_set->num_rows > 0) {
				while($row = $result_set->fetch_assoc()) {
					$results[] = $row;
				}
			}
			
			return $results;
		}
	}
?>