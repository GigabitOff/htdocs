<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\HtmlPurifier;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Users;
use app\models\Testi;
use app\models\TestiOtveti;
use app\models\TestiVoprosi;

class ApitestiController extends \yii\web\Controller
{



    public function actionCreatetest($parametr1, $parametr2, $parametr3,
                                     $parametr4, $parametr5, $parametr6,
                                     $parametr7, $parametr8, $parametr9,
                                     $parametr10, $parametr11,
                                     $parametr12, $parametr13,
                                     $parametr14, $parametr15,
                                     $parametr16, $parametr17,
                                     $parametr18, $parametr19,$parametr20)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{testi}} ORDER BY [[id]] DESC LIMIT 1')
                ->queryOne();
            $id_table_end = $data["id"] + 1;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                ->queryOne();
            $user_school = $model["school"];
            $user_city = $model["city"];
            $user_country = $model["country"];
            $date = date("Y-m-d H:i:s", strtotime($parametr1));
            $code_testa = rand(1000000, 999999999);
            $user_school = $model["school"];
            $user_city = $model["city"];
            $user_country = $model["country"];
            date_default_timezone_set('Europe/Kiev');
            $time_end_test = date("Y-m-d H:i", strtotime($date . " + $parametr20 minutes"));
            Yii::$app->db->createCommand("INSERT INTO {{testi}}([[id]], [[username]],[[user_id]], [[ticher_id]], [[country_id]], 
[[city_id]], [[school_id]], [[classnumber_id]], [[classlater_id]], [[name_test]], [[vopros_test]], [[variant_1]], [[variant_2]],
 [[variant_3]], [[variant_4]], [[variant_5]], [[variant_6]], [[variant_7]],[[value1]],[[value2]],[[value3]],[[value4]],[[value5]],[[value6]],[[value7]],
 [[date]], [[time]], [[dateandtime]], [[timeendtest]], [[status_test]], 
 [[active]], [[code_test]]) VALUES ('$id_table_end','','$user_id','$user_id','$user_country','$user_city','$user_school',
 '$parametr2','$parametr3','$parametr4','$parametr5','$parametr6','$parametr7','$parametr8','$parametr9','$parametr10',
 '$parametr11','$parametr12','$parametr13','$parametr14','$parametr15','$parametr16','$parametr17','$parametr18',
 '$parametr19','$parametr1','','','','1','1','$code_testa')")->execute();

            $summ_var_pole =  $this->actionReturnFalseSummPoleTesti($parametr1);
            Yii::$app->db->createCommand("UPDATE {{testi}} SET [[summ_variant_pole]] = '$summ_var_pole' WHERE  [[code_test]] = '$code_testa'")->execute();
            $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi_voprosi}} WHERE [[date]] = '$parametr1' AND [[name_test]] = '$parametr4'ORDER BY [[id]] DESC  ")->queryAll();
            foreach( $testsSummVopros as $valas){
            }
            if(!empty($valas["id"])){
                $test = $valas["code_test"];}else{$test = $code_testa;}
            $chek_yes = null;
            if($parametr13 == 1){$chek_yes = 1;}
            if($parametr14 == 1){$chek_yes = 2;}
            if($parametr15 == 1){$chek_yes = 3;}
            if($parametr16 == 1){$chek_yes = 4;}
            if($parametr17 == 1){$chek_yes = 5;}
            if($parametr18 == 1){$chek_yes = 6;}
            if($parametr19 == 1){$chek_yes = 7;}
            Yii::$app->db->createCommand("INSERT INTO {{testi_voprosi}}([[id]], [[username]],[[user_id]], [[ticher_id]], [[country_id]], 
[[city_id]], [[school_id]], [[classnumber_id]], [[classlater_id]],  [[name_test]], [[value_otveta_yes]], [[vopros_test]], [[variant_1]], [[variant_2]],
 [[variant_3]], [[variant_4]], [[variant_5]], [[variant_6]], [[variant_7]],[[value1]],[[value2]],[[value3]],[[value4]],[[value5]],[[value6]],[[value7]],
 [[date]], [[time]], [[dateandtime]], [[timeendtest]], [[status_test]], 
 [[active]], [[code_test]],[[code_voprosa]]) VALUES ('$id_table_end','','$user_id','$user_id','$user_country','$user_city','$user_school',
 '$parametr2','$parametr3','$parametr4','$chek_yes','$parametr5','$parametr6','$parametr7','$parametr8','$parametr9','$parametr10',
 '$parametr11','$parametr12','$parametr13','$parametr14','$parametr15','$parametr16','$parametr17','$parametr18',
 '$parametr19','$parametr1','','$time_end_test','','1','1','$test','$id_table_end')")->execute();
            $arr = array('respond' => 1,'code' => $code_testa,'test' => $test);
            $summ_var_pole =  $this->actionReturnFalseSummPole($parametr1);
            Yii::$app->db->createCommand("UPDATE {{testi_voprosi}} SET [[summ_variant_pole]] = '$summ_var_pole' WHERE  [[code_test]] = '$test' AND [[code_voprosa]] = '$id_table_end'")->execute();
            return HtmlPurifier::process(json_encode($arr));
        }
    }//Метод экранирован
    public function actionTestuserresponse()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $country = $model['country'];
            $city = $model['city'];
            $school = $model['school'];
            $roomnumber = $model['classnumber'];
            $roomlater = $model['classlater'];
            $resCount = Testi::find()->where(['active' => 1, 'country_id' => $country, 'city_id' => $city, 'school_id' => $school, 'classnumber_id' => $roomnumber, 'classlater_id' => $roomlater])->count('[[id]]');
            return "(+" . $resCount . ")";
        }
    } //Метод экранирован

    public function actionResponseTestValues()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $testsResponds = Yii::$app->db->createCommand("SELECT * FROM {{otveti_tests}} WHERE [[user_id]] = '$user_id' AND [[active]] = 1 ")->queryAll();
            foreach ($testsResponds as $values) {
                echo "<p>" . $values["name_test"];
            }
        }
    }

    public function actionTestsallandnew($param1, $param2)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $country = $model['country'];
            $city = $model['city'];
            $school = $model['school'];
            $roomnumber = $model['classnumber'];
            $roomlater = $model['classlater'];
            $testsRespond = Yii::$app->db->createCommand("SELECT * FROM {{testi}} WHERE [[country_id]] = '$country'
                   AND [[city_id]] = '$city' AND [[school_id]] = '$school' AND [[classnumber_id]] = '$roomnumber' 
                   AND [[classlater_id]] = '$roomlater' AND [[date]] >= '$param1' AND [[date]] <= '$param2' GROUP BY [[name_test]] ")->queryAll();
            foreach ($testsRespond as $value) {
               echo $code_test = $value['code_test'];
                $res = TestiOtveti::find()->where(['code_test' => $code_test])->count('[[id]]');
                if ($res < $value['summ_variant_pole']) {
                    $testsSearchOtvet = Yii::$app->db->createCommand("SELECT * FROM {{testi_otveti}} WHERE [[user_id]] = '$user_id' AND [[code_test]] = '$code_test ' AND [[country_id]] = '$country' AND [[city_id]] = '$city' AND [[school_id]] = '$school' AND [[classnumber_id]] = '$roomnumber' AND [[classlater_id]] = '$roomlater' ")->queryOne();
                  echo  $resultTestiVoprosiCount = TestiVoprosi::find()->where(['code_test' => $code_test])->count('[[id]]');
                   echo $resultTestiOtvetiCount = TestiOtveti::find()->where(['code_test' => $code_test])->count('[[id]]');
                    if ($resultTestiVoprosiCount != $resultTestiOtvetiCount) {
                        echo "<p style=' color: #606060;  ' >" . $value["name_test"] . "-<span>(" . $value["date"] . ")</span></p>";
                    } else {
                        echo "<p style=' color: #7B68EE;  ' >" . $value["name_test"] . "-<span>(" . $value["date"] . ")</span> - gffdТест пройден</p>";
                    }
                    $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi_voprosi}} WHERE [[code_test]] = '$code_test' ")->queryAll();
                    foreach ($testsSummVopros as $value) {
                        $code_voprosa = $value["code_voprosa"];
                        if ($value["code_voprosa"] != $testsSearchOtvet["code_voprosa"] and $res != $resultTestiVoprosiCount) {
                            echo "<span style='display: none; ' id='code_test' title='" . $value["code_test"] . "'>" . $value["code_test"] . "</span><p style='text-decoration: underline; color: #0062cc; cursor: pointer; ' onclick='TestClickOpen($code_test,$code_voprosa)'>" . $value["vopros_test"] . "-<span>(" . $value["date"] . ")</span></p>";
                        }
                    }
                }

            }
        }

    } //Метод экранирован

    public function actionTestsstartduble($param1, $param2, $param3)
    {
        if (!Yii::$app->user->isGuest) {
            $testsRespond = Yii::$app->db->createCommand("SELECT * FROM {{testi}} WHERE [[code_test]] = '$param1' AND [[date]] >= '$param2' AND [[date]] <= '$param3' ")->queryAll();
            $testsRespond[0]["name_test"];
            echo "<span style='display: none;' id='code_test' title='" . $testsRespond[0]["code_test"] . "'>" . $testsRespond[0]["code_test"] . "</span>";
            echo "<p>" . $testsRespond[0]["vopros_test"] . "</p>";
            $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi_voprosi}} WHERE [[code_test]] = '$param1' ")->queryAll();

            if ($testsSummVopros != false) {
                foreach ($testsSummVopros as $value) {

                    $code = $value["code_test"];
                    $summ_variant_otvet = $value["summ_variant_pole"];
                    for ($i = 1; $i <= $summ_variant_otvet; $i++) {
                        echo "<p><input  style='text-decoration: underline; color: #0062cc;' id='chek" . $i . "' onchange='TestOtvet($i,$code)' type='checkbox'>dddd" . $value["variant_" . $i] . "</input></p>";
                    }
                }
            } else {
                foreach ($testsRespond as $value) {
                    $code = $value["code_test"];
                    $summ_variant_otvet = $value["summ_variant_pole"];
                    for ($i = 1; $i <= $summ_variant_otvet; $i++) {
                        echo "<p><input  style='text-decoration: underline; color: #0062cc;' id='chek" . $i . "' onchange='TestOtvet($i,$code)' type='checkbox'>ssss" . $value["variant_" . $i] . "</input></p>";
                    }
                }
            }
        }
    }

    public function actionTestsstart($param1, $param2, $param3, $code_voprosa = null)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $country = $model['country'];
            $city = $model['city'];
            $school = $model['school'];
            $roomnumber = $model['classnumber'];
            $roomlater = $model['classlater'];
            $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi_voprosi}} WHERE [[code_test]] = '$param1' AND [[code_voprosa]] = '$code_voprosa'")->queryAll();
            $testsRespondPoiskVoprosa = Yii::$app->db->createCommand("SELECT * FROM {{testi_otveti}} WHERE [[code_test]] = '$param1' AND [[code_voprosa]] = '$code_voprosa'")->queryOne();
            $testsRespond = Yii::$app->db->createCommand("SELECT * FROM {{testi}} WHERE [[code_test]] = '$param1'  ")->queryAll();
            $testsRespond[0]["name_test"];
            if (!empty($testsSummVopros[0]["vopros_test"])) {
                if (empty($testsRespondPoiskVoprosa)) {
                    echo "<span style='display: none;' id='code_test' title='" . $testsRespond[0]["code_test"] . "'>" . $testsRespond[0]["code_test"] . "</span>";
                    echo "<p>" . $testsSummVopros[0]["vopros_test"] . "</p>";
                    if (!empty($testsSummVopros)) {
                        foreach ($testsSummVopros as $value) {
                            $code = $value["code_test"];
                            $summ_variant_otvet = $value["summ_variant_pole"];
                            for ($i = 1; $i <= $summ_variant_otvet; $i++) {
                                echo "<p><input  style='text-decoration: underline; color: #0062cc;' id='chek" . $i . "' onchange='TestOtvet($i,$code,$code_voprosa)' type='checkbox'>" . $value["variant_" . $i] . "</input></p>";
                            }
                        }
                    }
                }
            } else {
                $user_id = Yii::$app->user->id;
                $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
                $country = $model['country'];
                $city = $model['city'];
                $school = $model['school'];
                $roomnumber = $model['classnumber'];
                $roomlater = $model['classlater'];
                $testsRespond = Yii::$app->db->createCommand("SELECT * FROM {{testi}} WHERE [[country_id]] = '$country'
 AND [[city_id]] = '$city' AND [[school_id]] = '$school' AND [[classnumber_id]] = '$roomnumber' 
 AND [[classlater_id]] = '$roomlater' AND [[date]] >= '$param2' AND [[date]] <= '$param3' GROUP BY [[name_test]] ")->queryAll();
                foreach ($testsRespond as $value) {
                    $code_test = $value['code_test'];
                    $res = TestiOtveti::find()->where(['code_test' => $code_test])->count('[[id]]');
                    $resultTestiVoprosiCount = TestiVoprosi::find()->where(['code_test' => $code_test])->count('[[id]]');
                    if ($res < $value['summ_variant_pole']) {
                        $resultTestiVoprosiCount = TestiVoprosi::find()->where(['code_test' => $code_test])->count('[[id]]');
                        $resultTestiOtvetiCount = TestiOtveti::find()->where(['code_test' => $code_test])->count('[[id]]');
                        if ($resultTestiVoprosiCount != $resultTestiOtvetiCount) {
                            echo "<p>Список сформованих тестів за період</p><p style=' color: #606060;  ' >" . $value["name_test"] . "-<span>(" . $value["date"] . ")</span></p>";
                            $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi_voprosi}} WHERE [[code_test]] = '$code_test' ")->queryAll();
                            foreach ($testsSummVopros as $value) {
                                $code_voprosa = $value["code_voprosa"];
                                $testsSearchOtvet = Yii::$app->db->createCommand("SELECT * FROM {{testi_otveti}} WHERE [[user_id]] = '$user_id' AND  [[code_test]] = '$code_test ' AND [[code_voprosa]] = '$code_voprosa'")->queryAll();

                                if ($res != $resultTestiVoprosiCount) {
                                    if (empty($testsSearchOtvet)) {
                                        echo "<span style='display: none; ' id='code_test' title='" . $value["code_test"] . "'>" . $value["code_test"] . "</span><p style='text-decoration: underline; color: #0062cc; cursor: pointer; ' onclick='TestClickOpenResponseDuble($code_test,$code_voprosa)'>" . $value["vopros_test"] . "-<span>(" . $value["date"] . ")</span></p>";
                                    }
                                }
                            }
                        } else {
                            echo "<p>Список сформованих тестів за період</p><p style=' color: #7B68EE;  ' >" . $value["name_test"] . "-<span>(" . $value["date"] . ")</span>-Пройден</p>";
                        }
                    }
                }
            }
        }
    }

    //Метод экранирован

    public function Tss($param1, $param2)
    {
        $testsSearchOtvet = Yii::$app->db->createCommand("SELECT * FROM {{testi_otveti}} WHERE [[code_test]] = '$param1' AND [[code_voprosa]] = '$param2' ")->queryAll();
        return $testsSearchOtvet;
    }

    public function actionTestotvetvariantuser($param1, $param2, $param3)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $testsRespond = Yii::$app->db->createCommand("SELECT * FROM {{testi}} WHERE [[code_test]] = '$param2' AND [[value1]] != 'undefined' OR [[value2]] != 'undefined' 
OR [[value3]] != 'undefined' OR [[value4]] != 'undefined' OR [[value5]] != 'undefined' OR [[value6]] != 'undefined' 
OR [[value7]] != 'undefined' OR [[value8]] != 'undefined' OR [[value9]] != 'undefined' OR [[value10]] != 'undefined'")->queryOne();
            $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{testi_otveti}} ORDER BY [[id]] DESC LIMIT 1')->queryOne();
            $id_table_end = $data["id"] + 1;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $country = $model['country'];
            $city = $model['city'];
            $school = $model['school'];
            $roomnumber = $model['classnumber'];
            $roomlater = $model['classlater'];
            $code_voprosa = $id_table_end + 1;
            $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi_voprosi}} WHERE [[code_test]] = '$param2' AND [[code_voprosa]] = '$param3'")->queryAll();
            foreach ($testsSummVopros as $val) {
                $code_voprosa = $val["code_voprosa"];
                $code_test = $val["code_test"];
                Yii::$app->db->createCommand("INSERT INTO {{testi_otveti}}([[id]], [[username]],[[user_id]], 
[[ticher_id]], [[country_id]], 
[[city_id]], [[school_id]], [[classnumber_id]], [[classlater_id]], [[value_otveta]],[[value_otveta_yes]],
 [[date]], [[time]], [[dateandtime]], [[timeendtest]], [[status_test]], 
 [[active]], [[code_test]],[[code_voprosa]]) VALUES ('$id_table_end','','$user_id','','$country','$city','$school','$roomnumber','$roomlater ','$param1',
 '" . $this->actionTestProverkaVariantOvetaYes($param2) . "','','','','','1','1','$param2','$param3')")->execute();
            }
        }
    }//Метод экранирован

    public function actionTestProverkaVariantOvetaYes($param1)
    {
        if (!Yii::$app->user->isGuest) {
            $testsRespond = Yii::$app->db->createCommand("SELECT * FROM {{testi}} WHERE [[code_test]] = '$param1'")->queryAll();
            foreach ($testsRespond as $val) {
                if ($val["value1"] == 1) {
                    return 1;
                }
                if ($val["value2"] == 1) {
                    return 2;
                }
                if ($val["value3"] == 1) {
                    return 3;
                }
                if ($val["value4"] == 1) {
                    return 4;
                }
                if ($val["value5"] == 1) {
                    return 5;
                }
                if ($val["value6"] == 1) {
                    return 6;
                }
                if ($val["value7"] == 1) {
                    return 7;
                }
                if ($val["value8"] == 1) {
                    return 8;
                }
                if ($val["value9"] == 1) {
                    return 9;
                }
                if ($val["value10"] == 1) {
                    return 10;
                }
            }
        }
    }

    public function actionTestsotveti($param1)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $country = $model['country'];
            $city = $model['city'];
            $school = $model['school'];
            $roomnumber = $model['classnumber'];
            $roomlater = $model['classlater'];
            $testsRespond = Yii::$app->db->createCommand("SELECT * FROM {{testi_otveti}} WHERE [[code]] = '$country' GROUP BY [[date]]")->queryAll();
            foreach ($testsRespond as $value) {
                echo "<p>" . $value["name_test"];
            }
        }
    } //Метод экранирован

    public function actionTestsotveticreate($parametr1, $parametr2, $parametr3,
                                            $parametr4, $parametr5, $parametr6,
                                            $parametr7, $parametr8, $parametr9,
                                            $parametr10, $parametr11,
                                            $parametr12, $parametr13,
                                            $parametr14, $parametr15,
                                            $parametr16, $parametr17,
                                            $parametr18, $parametr19)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{otveti_testi}} ORDER BY [[id]] DESC LIMIT 1')->queryOne();
            $id_table_end = $data["id"] + 1;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")->queryOne();
            $user_school = $model["school"];
            $user_city = $model["city"];
            $user_country = $model["country"];
            Yii::$app->db->createCommand("INSERT INTO {{testi_otveti}}([[id]], [[username]],[[user_id]], [[ticher_id]], [[country_id]], 
[[city_id]], [[school_id]], [[classnumber_id]], [[classlater_id]], [[name_test]], [[vopros_test]], [[variant_a]], [[variant_b]],
 [[variant_c]], [[variant_d]], [[variant_i]], [[variant_f]], [[variant_g]],[[value1]],[[value2]],[[value3]],[[value4]],[[value5]],[[value6]],[[value7]],
 [[date]], [[time]], [[dateandtime]], [[timeendtest]], [[status_test]], 
 [[active]], [[code_test]]) VALUES ('$id_table_end','','$user_id','$user_id','$user_country','$user_city','$user_school','$parametr2','$parametr3','$parametr4','$parametr5','$parametr6','$parametr7','$parametr8','$parametr9','$parametr10','$parametr11','$parametr12','$parametr13','$parametr14','$parametr15','$parametr16','$parametr17','$parametr18','$parametr19','$parametr1','','','','1','1','')")->execute();
        }
    } //Метод экранирован


 ///////Курл метод ищем записи которых нет в таблице testi_voprosi

public function actionTtts(){

    $datastest = Yii::$app->db->createCommand('SELECT * FROM {{testi}} ')
        ->queryAll();
    foreach($datastest as $values){
        $datetest = $values["code_test"];
        $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi_voprosi}} WHERE [[code_test]] = '$datetest'")->queryAll();
         if(empty($testsSummVopros)){
          Yii::$app->db->createCommand("DELETE FROM {{testi}} WHERE [[code_test]] = '$datetest' AND [[status_test]] != '100'")->execute();
         }
    }
//////////Курл метод


   // if(empty($testsSummVopros)){

     //   echo "No this";
      //  Yii::$app->db->createCommand("DELETE FROM {{testi}} WHERE [[code_test]] = '$date'")->execute();

   // }

}

    public function actionReturnFalseSummPoleTesti($date){
        $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi}} WHERE [[date]] = '$date' ORDER BY [[id]] DESC LIMIT 1 ")->queryAll();
        foreach( $testsSummVopros as $valas){}
        if(!empty($valas["id"])){
            $vals_summ = 0;
            $vals_summ_tu = 1;
            $var0 = $valas["variant_1"];
            $var1 = $valas["variant_2"];
            $var2 = $valas["variant_3"];
            $var3 = $valas["variant_4"];
            $var4 = $valas["variant_5"];
            $var5 = $valas["variant_6"];
            $var6 = $valas["variant_7"];
            $var7 = $valas["variant_8"];
            $var8 = $valas["variant_9"];
            $var9 = $valas["variant_10"];
            if( $var0 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var1 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var2 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var3 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var4 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var5 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var6 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var7 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var8 != false){
                $vals_summ = $vals_summ + 1;
            }
            if($var9 != false){
                $vals_summ = $vals_summ + 1;
            }


            return $vals_summ;

        }
    }

    public function actionReturnFalseSummPole($date){
    $testsSummVopros = Yii::$app->db->createCommand("SELECT * FROM {{testi_voprosi}} WHERE [[date]] = '$date' ORDER BY [[id]] DESC LIMIT 1 ")->queryAll();
    foreach( $testsSummVopros as $valas){}
    if(!empty($valas["id"])){
        $vals_summ = 0;
        $vals_summ_tu = 1;
        $var0 = $valas["variant_1"];
        $var1 = $valas["variant_2"];
        $var2 = $valas["variant_3"];
        $var3 = $valas["variant_4"];
        $var4 = $valas["variant_5"];
        $var5 = $valas["variant_6"];
        $var6 = $valas["variant_7"];
        $var7 = $valas["variant_8"];
        $var8 = $valas["variant_9"];
        $var9 = $valas["variant_10"];
      if( $var0 != false){
        $vals_summ = $vals_summ + 1;
      }
        if($var1 != false){
            $vals_summ = $vals_summ + 1;
        }
        if($var2 != false){
            $vals_summ = $vals_summ + 1;
        }
        if($var3 != false){
            $vals_summ = $vals_summ + 1;
        }
        if($var4 != false){
            $vals_summ = $vals_summ + 1;
        }
        if($var5 != false){
            $vals_summ = $vals_summ + 1;
        }
        if($var6 != false){
            $vals_summ = $vals_summ + 1;
        }
        if($var7 != false){
            $vals_summ = $vals_summ + 1;
        }
        if($var8 != false){
            $vals_summ = $vals_summ + 1;
        }
        if($var9 != false){
            $vals_summ = $vals_summ + 1;
        }


        return $vals_summ;

    }
}


}
