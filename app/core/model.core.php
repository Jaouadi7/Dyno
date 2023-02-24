<?php

trait Model {

    use Database;

    public function __construct ( ) {
        
    }
    
    // GET ALL DATA FROM DATABASE TABLE
    public function get_all ( $order_by = 'id', $order_type = 'desc'  ) {
 
        $query = "SELECT * FROM $this->table order by $order_by $order_type";

        return $this->readDB( $query );

    }

    // INSERT DATA TO THE DATABASE TABLE
    public function insert ( $data ) {

        if ( ! empyt ( $this->allowed_columns ) ):

            foreach ( $data as $key => $value ):

                if ( ! in_array ( $key, $this->allowed_columns ) ):

                    unset( $data[$key] );

                endif;

            endforeach;

        endif;


        $keys = array_keys( $data );

        $query  = "INSERT INTO $this->table";
        $query .= " ( " . implode( ', ', $keys ) . " ) VALUES";
        $query .= " ( :" . implode( ', :', $keys ) . " )";

        $this->writeDB( $query, $data );

    }

    // UPDATE DATA ON DATABASE TABLE
    public function update ( $data, $id = '', $column_id = 'id' ) {


        if (  ! empty ( $id ) &&  is_int( $id )  ) :

            if ( ! empyt ( $this->allowed_columns ) ):


                foreach ( $data as $key => $value ):

                    if ( ! in_array ( $key, $this->allowed_columns ) ):
        
                        unset( $data[$key] );
        
                    endif;
        
                endforeach;

            endif;

            $query = "UPDATE " . $this->table . " " ;
            
            foreach ( $data as $key ):
         
                $query .=  $key . " = :" . $key . ", ";

            endforeach;
            
            $query = trim( $query, ", " );
 
            $query .= " WHERE $column_id = :$column_id ";

            $data[$column_id] = $id;

            return $this->writeDB( $query, $data );

        endif;

        return false;

    }

    // DELETE DATA FROM DATABASE TABLE
    public function delete ( $id = '', $column_id = 'id' ) {

        if ( is_int( $id ) && ! empty ( $id ) ) :

            $query = "DELETE FROM " . $this->table . " WHERE $column_id = :$column_id LIMIT 1";

            $data[$column_id] = $id;

            return $this->writeDB( $query, $data );

        endif;

        return false;

    }

    // SELECT DATA WHERE IN DATABASE TABLE
    public function where ( $data, $data_not = [], $order_by = 'id', $order_type = 'desc', $limit = '' ) {

        $keys = array_keys( $data );
        $keys_not = array_keys( $data_not );

        $query = "SELECT * FROM " . $this->table . " WHERE ";

        foreach ( $keys as $key ):
         
            $query .=  $key . " = :" . $key . " && ";

        endforeach;

        foreach ( $keys_not as $key ):

            $query .= $key . " != :" . $key . " && ";

        endforeach;

        $query = trim( $query, " && " );

        $query .= " order by $order_by $order_type ";

        ! empty ( $limit ) && is_int( $limit )  ??  $query .= " LIMIT " .  strval($limit);

        $data = array_merge( $data, $data_not );

        return $this->readDB( $query, $data );

    }


}