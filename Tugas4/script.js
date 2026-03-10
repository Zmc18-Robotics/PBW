function menghitungnilai(){

let nilai = parseInt(document.getElementById("nilai").value);
let grade = "";

    if(nilai < 0 || nilai > 100){
        document.getElementById("hasil").innerHTML = "Nilai yang anda masukan tidak valid";
    }else if(nilai >= 80){
        grade = "A";
    }else if(nilai >= 70){
        grade = "B";
    }else if(nilai >= 60){
        grade = "C";
    }else if(nilai >= 50){
        grade = "D";
    }else{
        grade = "E";
    }

    if(grade !== ""){
        document.getElementById("hasil").innerHTML = "Grade Anda: " + grade;
    }
    document.getElementById("formnilai").reset();
}   