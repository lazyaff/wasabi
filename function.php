<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "qwerty", "wasabi");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function add($data) {
    global $conn;
    // import data mata kuliah
    $smt = $data["smt"];
    $kd_mk = rand(1000,9000) + rand(0,500) + rand(0,499);
    $nama_mk = $data["nama_mk"];
    $sks = $data["sks"];
    // import data nilai kommponen
    for ($i=1;$i<=100;$i++) {
        if (isset($data["komp-${i}"])) {
            $komp = $data["komp-${i}"];
            $bob = $data["bob-${i}"];
            $nil = $data["nil-${i}"];
            // tambahkan data baru ke database
            mysqli_query($conn, "INSERT INTO mk VALUES('$smt', '$kd_mk', '$nama_mk', '$sks', '$komp', '$bob', '$nil')");
        }
    }
    return mysqli_affected_rows($conn);
}

function filter($keyword) {
    if ($keyword == 0) {
        $query = "SELECT *, round(sum(nil*(bob/100))) as nilai 
                FROM `mk` 
                group by nama_mk 
                order by nama_mk
			";
    } else {
        $query = "SELECT *, round(sum(nil*(bob/100))) as nilai 
                FROM `mk` 
                where smt = '$keyword'
                group by nama_mk 
                order by nama_mk
			";
    }
    return query($query);
}

function delete($data) {
    global $conn;
    if ($data == 0) {
        mysqli_query($conn, "DELETE FROM mk");
    } elseif ($data > 0 && $data < 1000) {
        mysqli_query($conn, "DELETE FROM mk WHERE smt = $data");
    } else {
        mysqli_query($conn, "DELETE FROM mk WHERE kd_mk = $data");
    }
    return mysqli_affected_rows($conn);
}

function edit($data) {
    global $conn;
    // import data mata kuliah
    $smt = $data["smt"];
    $kd_mk = $data["kd_mk"];
    $nama_mk = $data["nama_mk"];
    $sks = $data["sks"];
    // hapus data lama
    mysqli_query($conn, "DELETE FROM mk WHERE kd_mk = $kd_mk");
    // import data nilai kommponen
    for ($i=1;$i<=100;$i++) {
        if (isset($data["komp-${i}"])) {
            $komp = $data["komp-${i}"];
            $bob = $data["bob-${i}"];
            $nil = $data["nil-${i}"];
            // tambahkan data baru ke database
            mysqli_query($conn, "INSERT INTO mk VALUES('$smt', '$kd_mk', '$nama_mk', '$sks', '$komp', '$bob', '$nil')");
        }
    }
    return mysqli_affected_rows($conn);
}

?>