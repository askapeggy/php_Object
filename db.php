<?php
class DB
{
    //存取網路位置
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=crud";
    //資料庫物件
    protected $pdo;
    //資料表
    protected $table;
    
    // 建構式
    function __construct($table)
    {
        $this->table = $table;
        // 開啟資料庫
        $this->pdo = new PDO($this->dsn,'root', '');
    }
    ////////////////////////////////////////////////////////////////
    //收尋資料
    // 撈回所有資料 回傳資料
    // 1.整張資料表
    // 2.有條件
    // 3.其他SQL功能
    function all(...$arg)
    {
        $sql = "SELECT * FROM $this->table ";
        // 先判斷是否有帶入參數
        if(!empty($arg[0]))
        {
            // 判斷是否為陣列  如果是就要轉換
            if(is_array($arg[0]))
            {//轉換資料
                $where = $this->a2s($arg[0]);
                $sql = $sql." WHERE ".join(" && ", $where);
                if(!empty($arg[1]))
                {
                    $sql .= $arg[1];
                }
            }else
            {//不是陣列就要放在原始後面
                $sql .= $arg[0];
            }
        }
        return $this->fetchAll($sql);
    }
    // 找回一筆 回傳資料
    // 1.整張資料表
    // 2.有條件
    // 3.其他SQL功能
    function find($id)
    {
        $sql = "SELECT * FROM $this->table ";
        
        // 判斷是否為陣列  如果是就要轉換
        if(is_array($id))
        {//轉換資料
            $where = $this->a2s($id);
            $sql = $sql." WHERE ".join(" && ", $where);
        }else
        {//不是陣列就要放在原始後面
            $sql .= " WHERE `id`='$id' ";
        }
        return $this->fetchOne($sql);
    }
    // 把陣列轉成條件字串
    function a2s($array)
    {
        $tmp=[];
        foreach($array as $key=>$value)
        {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }
    // 找單一一筆
    function fetchOne($sql)
    {
        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    // 找回全部相符合資料
    function fetchAll($sql)
    {
        //echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    ////////////////////////////////////////////////////////////////////
    // 刪除資料
    function del($id)
    {
        $sql = "DELETE FROM $this->table ";
        
        // 判斷是否為陣列  如果是就要轉換
        if(is_array($id))
        {//轉換資料
            $where = $this->a2s($id);
            $sql = $sql." WHERE ".join(" && ", $where);
        }else
        {//不是陣列就要放在原始後面
            $sql .= " WHERE `id`='$id' ";
        }
        return $this->pdo->exec($sql);
    }
    ////////////////////////////////////////////////////////////////////
    //新增 修改
    function save($array)
    {
        if(isset($array['id']))
        {//更新
            $data = $array['id'];
            unset($array['id']);
            $set= $this->a2s($array);
            $sql = "UPDATE $this->table SET ".join(',',$set)." WHERE `id`= '{$data}'";
        }else
        {//新增
            $cols = array_key($array);
            $sql="INSERT INTO $this->table (`".join("','", $cols)."`) VALUES('".join(',', $array)."')";
        }
        //echo $sql;
        return $this->pdo->exec($sql);
    }

}
/*
    // 收尋資料庫 回傳資料
    function q($sql)
    {
        return $this->pdo->query($sql)->fetchall();
    }
        */

// 印出矩陣資料
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$DEPT = new DB('member');
//" Order by 'id' DESC ";
//'id'=>'1'
//$dept=$DEPT->all();
//$dept=$DEPT->find("3");
//$DEPT->del('2');
//dd($dept);
$DEPT->save(['id'=>'11', 'email'=>'123456']);
?>