<?php 

namespace App\Controllers;
defined('FCPATH') OR exit('No direct script access allowed');
use App\Models\DataControllerModel as DCM;
use Exception;
use mPDF;

class DataController extends BaseController {

    private $ave_beans_w = 1.44;
    private $ave_pods_w = 400;
    private $ave_beans_count = 0;

    //Accessor and Mutator
    public function setAveBeansWeight($ave_beans_w) {
        $this->ave_beans_w = $ave_beans_w;
    }

    public function getAveBeansWeight() {
        return $this->ave_beans_w;
    }

    public function setAvePodsWeight($ave_pods_w) {
        $this->ave_pods_w = $ave_pods_w;
    }

    public function getAvePodsWeight() {
        return $this->ave_pods_w;
    }

    public function setAveBeansCount($count) {
        $this->ave_beans_count = $count;
    }

    public function getAveBeansCount() {
        return $this->ave_beans_count;
    }

    public function tree_Analytics() {
        $arr = [];
        $get_data = DCM::getTreeData();
        $response = [];
        
        try {
            foreach ($get_data->getResult() as $row) {
                $arr[] = [
                    $row->tree_id,
                    $row->varieties,
                    $row->surveyor_name,
                    date('F d, Y',strtotime($row->date_surveyed)),
                    $row->lat_y_dd . " Φ",
                    $row->long_x_dd . " λ",
                    date('F d, Y',strtotime($row->last_fertilize)),
                    //date('F d, Y',strtotime($row->expected_harvest_date))
                ];
            }
    
            $response = [
                'data' => $arr
            ];
        } catch (\Exception $e) {
            $response = [
                'data' => "Something Went Wrong.",
                'error' => $e
            ];
        }

        return $this->response->setJSON($response);
        exit;
    }

    public function pods_Analytics() {
        $year = strval($this->request->getVar('year'));
        $current_month = date('n');
        $current_year = date('Y');
        $new_month = "";
        $arr1 = [];
        $arr2 = [];
        $arr3 = [];
        $arr4 = [];
        $arr5 = [];
        $pod_sum = 0;
        $current_total_pods = 0;
        $previous_total_pods = 0;
        $pods_percentage = 0;
        $response = [];

        if ($year != $current_year) { 
            $current_month = 12;
        }

        try {
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("UF-18", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum;
                    }
                    array_push($arr1, $pod_sum);
                }
            }
    
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("BR 25", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum;
                    }
                    array_push($arr2, $pod_sum);
                }
            }
    
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("PBC 123", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum;
                    }
                    array_push($arr3, $pod_sum);
                }
            }
    
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("K2", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum;
                    }
                    array_push($arr4, $pod_sum);
                }
            }
    
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("K9", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum;
                    }
                    array_push($arr5, $pod_sum);
                }
            }

            //<!--Current Total Pods-->
            $get_total = DCM::getTotalPods($year);
            foreach($get_total->getResult() as $row) {
                if ($get_total->getNumRows() == null) {
                    $current_total_pods = 0;
                } else {
                    $current_total_pods += $row->pods_num;
                }
            }
            //<!--Current Total Pods-->
            
            //<!--Previous Total Pods-->
            $get_total = DCM::getTotalPods($year - 1);
            foreach($get_total->getResult() as $row) {
                if ($get_total->getNumRows() == null) {
                    $previous_total_pods = 0;
                } else {
                    $previous_total_pods += $row->pods_num;
                }
            }
            //<!--Previous Total Pods-->

            //<!--Pods Percentage-->
            $difference_pods = $current_total_pods - $previous_total_pods;
            if ($previous_total_pods != 0) {
                $result_diff_pods = $difference_pods / $previous_total_pods;
                $pods_percentage = $result_diff_pods * 100;
            } else {
                $pods_percentage = 0;
            }
            //<!--Pods Percentage-->        
    
            $response = [
                'status' => 200,
                'var1' => $arr1,
                'var2' => $arr2,
                'var3' => $arr3,
                'var4' => $arr4,
                'var5' => $arr5,
                'month' => $current_month,
                'variant_growth' => $pods_percentage
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return $this->response->setJSON($response);
        exit;
    }

    public function beans_Pod_Data() {
        $year = strval($this->request->getVar('year'));
        $current_month = date('n');
        $current_year = date('Y');
        $new_month = "";
        $beans = [];
        $pods = [];
        $beans_sum = 0;
        $pods_sum = 0;
        $current_total_beans = 0;
        $previous_total_beans = 0;
        $current_total_pods = 0;
        $previous_total_pods = 0;
        $total_percentage = 0;
        $total = 0;
        $response = [];

        if ($year != $current_year) { 
            $current_month = 12;
        }

        try {
           
            for($j = 1; $j <= $current_month; $j++) {
                $pods_sum = 0;
                $beans_sum = 0;
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getTotalPodsStats($new_month, $year);
            
                foreach($get_total->getResult() as $row) {
                    if ($get_total->getNumRows() > 0) {
                        $pods_sum = $pods_sum + $row->pods_num;
                        switch ($row->varieties) {
                            case "BR 25":
                                $this->setAveBeansCount(27);
                                $beans_sum += $row->pods_num * $this->getAveBeansCount();
                                break;
                            case "UF-18":
                                $this->setAveBeansCount(27);
                                $beans_sum += $row->pods_num * $this->getAveBeansCount();
                                break;
                            case "PBC 123":
                                $this->setAveBeansCount(27);
                                $beans_sum += $row->pods_num * $this->getAveBeansCount();
                                break;
                            case "K2":
                                $this->setAveBeansCount(34);
                                $beans_sum += $row->pods_num * $this->getAveBeansCount();
                                break;
                            case "K9":
                                $this->setAveBeansCount(24);
                                $beans_sum += $row->pods_num * $this->getAveBeansCount();
                                break;
                            default:
                                $beans_sum = 0;
                        }
                    }
                }
                
                array_push($pods, $pods_sum);
                array_push($beans, $beans_sum);
            }

            //<!--Current Total Pods and Beans-->
            $get_total = DCM::getTotalPods($current_year);
            foreach($get_total->getResult() as $row) {
                $current_total_pods += $row->pods_num;
                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $current_total_beans = 0;
                }
            }
            //<!--Current Total Pods and Beans-->
            
            //<!--Previous Total Pods and Beans-->
            $get_total = DCM::getTotalPods($current_year - 1);
            foreach($get_total->getResult() as $row) {
                $previous_total_pods += $row->pods_num;
                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $previous_total_beans = 0;
                }
            }
            //<!--Previous Total Pods and Beans-->

            //Get Growth Percentage
            $current_total = $current_total_beans + $current_total_pods;
            $previous_total = $previous_total_beans + $previous_total_pods;

            $diff = $current_total + $previous_total;

            if ($previous_total != 0) {
                $result = $diff / $previous_total;
                $total_percentage = $result * 100;
            } else {
                $total_percentage = 0;
            }
    
            $response = [
                'status' => 200,
                'beans_data' => $beans,
                'pods_data' => $pods,
                'month' => $current_month,
                'total_percentage' => $total_percentage,
                't' => $total
            ];    
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'message' => $e->getMessage()
            ];    
        }

        return $this->response->setJSON($response);
        exit;
    }

    public function get_Widget_Data() {
        $current_year = date('Y');
        $current_total_beans = 0;
        $previous_total_beans = 0;
        $beans_percentage = 0;
        $current_total_pods = 0;
        $previous_total_pods = 0;
        $pods_percentage = 0;
        $full_total_beans = 0;
        $full_total_pods = 0;
        $total_beans_weight = 0;
        $total_pods_weight = 0;
        $beans_w_percentage = 0;
        $pods_w_percentage = 0;
        $c_growth = 0;
        $response = [];

        try {
            $beans_summation = 0;
            //<!-- Full Total of Pods -->
            $get_total = DCM::getFullTotalPods();
            foreach($get_total->getResult() as $row) {
                $full_total_pods = $full_total_pods + $row->pods_num;

                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $beans_summation = $beans_summation + $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $beans_summation = $beans_summation + $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $beans_summation = $beans_summation + $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $beans_summation = $beans_summation + $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $beans_summation = $beans_summation + $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $beans_summation = 0;
                }
            }
            //<!-- Full Total of Pods -->

            //<!-- Full Total of Beans -->
            if ($full_total_pods > 0) {
                $full_total_beans = $beans_summation;
            } else {
                $full_total_beans = 0;
            }
            //<!-- Full Total of Beans -->

            //<!--Current Total Pods and Beans-->
            $get_total = DCM::getTotalPods($current_year);
            foreach($get_total->getResult() as $row) {
                $current_total_pods += $row->pods_num;
                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $current_total_beans = 0;
                }
            }
            //<!--Current Total Pods and Beans-->
            
            //<!--Previous Total Pods and Beans-->
            $get_total = DCM::getTotalPods($current_year - 1);
            foreach($get_total->getResult() as $row) {
                $previous_total_pods += $row->pods_num;
                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $previous_total_beans = 0;
                }
            }
            //<!--Previous Total Pods and Beans-->

            //<!--Beans Percentage-->
            $difference_beans = $current_total_beans - $previous_total_beans;
            if ($previous_total_beans != 0) {
                $result_diff_beans = $difference_beans / $previous_total_beans;
                $beans_percentage = $result_diff_beans * 100;
            } else {
                $beans_percentage = 0;
            }
            //<!--Beans Percentage-->
            
            //<!--Pods Percentage-->
            $difference_pods = $current_total_pods - $previous_total_pods;
            if ($previous_total_pods != 0) {
                $result_diff_pods = $difference_pods / $previous_total_pods;
                $pods_percentage = $result_diff_pods * 100;
            } else {
                $pods_percentage = 0;
            }
            //<!--Pods Percentage-->    
            
            // <-- Pods and Beans Weights -->
            $total_beans_weight = $full_total_beans * $this->getAveBeansWeight();
            $total_pods_weight = $full_total_pods * $this->getAvePodsWeight();
            // <-- Pods and Beans Weights -->

            //<-- Beans Weight Percentage -->
            $previous_beans_weight = $previous_total_beans * $this->getAveBeansWeight();
            $current_weight_beans = $total_beans_weight + $previous_beans_weight;
            $difference_beans_weight = $current_weight_beans - $previous_beans_weight;
            if ($previous_beans_weight != 0) {
                $result_diff_beans_weight = $difference_beans_weight / $previous_beans_weight;
                $beans_w_percentage = $result_diff_beans_weight * 100;
            } else {
                $beans_w_percentage = 0;
            }
            //<-- Beans Weight Percentage -->

            //<-- Pods Weight Percentage -->
            $previous_pods_weight = $previous_total_pods * $this->getAveBeansWeight();
            $current_weight_pods = $total_pods_weight + $previous_pods_weight;
            $difference_pods_weight = $current_weight_pods - $previous_pods_weight;
            if ($previous_pods_weight != 0) {
                $result_diff_pods_weight = $difference_pods_weight / $previous_pods_weight;
                $pods_w_percentage = $result_diff_pods_weight * 100;
            } else {
                $pods_w_percentage = 0;
            }
            //<-- Pods Weight Percentage -->
    
            $response = [
                'status' => 200,
                'total_beans' => $full_total_beans,
                'total_pods' => $full_total_pods,
                'beans_percentage' => $beans_percentage,
                'pods_percentage' => $pods_percentage,
                'beans_w' => $total_beans_weight,
                'beans_w_percentage' => $beans_w_percentage,
                'pods_w' => $total_pods_weight,
                'pods_w_percentage' => $pods_w_percentage
            ];
        } catch(\Exception $e) {
            $response = [
                'status' => 500,
                'message' => $e->getMessage(),
                'total_beans' => 0,
                'total_pods' => 0,
                'beans_percentage' => 0,
                'pods_percentage' => 0,
                'beans_w' => 0,
                'beans_w_percentage' => 0,
                'pods_w' => 0,
                'pods_w_percentage' => 0
            ];
        }

        return $response;
    }

    public function beans_Analytics() {
        $year = strval($this->request->getVar('year'));
        $current_month = date('n');
        $current_year = date('Y');
        $new_month = "";
        $arr1 = [];
        $arr2 = [];
        $arr3 = [];
        $arr4 = [];
        $arr5 = [];
        //$pod_sum = 0;
        $current_total_pods = 0;
        $previous_total_pods = 0;
        $pods_percentage = 0;
        $previous_total_beans = 0;
        $current_total_beans = 0;
        $response = [];

        if ($year != $current_year) { 
            $current_month = 12;
        }

        try {
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("UF-18", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    $this->setAveBeansCount(27);
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum * $this->getAveBeansCount();
                    }
                    array_push($arr1, $pod_sum);
                }
            }
    
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("PBC 123", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    $this->setAveBeansCount(27);
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum * $this->getAveBeansCount();
                    }
                    array_push($arr2, $pod_sum);
                }
            }
    
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("BR 25", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    $this->setAveBeansCount(27);
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum * $this->getAveBeansCount();
                    }
                    array_push($arr3, $pod_sum);
                }
            }
    
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("K2", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    $this->setAveBeansCount(34);
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum * $this->getAveBeansCount();
                    }
                    array_push($arr4, $pod_sum);
                }
            }
    
            for($j = 1; $j <= $current_month; $j++) {
                if ($j <= 9) {
                    $new_month = "0" . $j;
                }
                $get_total = DCM::getVariantData("K9", $new_month, $year);
                foreach($get_total->getResult() as $row) {
                    $this->setAveBeansCount(24);
                    if ($row->sum == null) {
                        $pod_sum = 0;
                    } else {
                        $pod_sum = $row->sum * $this->getAveBeansCount();
                    }
                    array_push($arr5, $pod_sum);
                }
            }

            //<!--Current Total Pods-->
            $get_total = DCM::getTotalPods($year);
            foreach($get_total->getResult() as $row) {
                $current_total_pods += $row->pods_num;
                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $current_total_beans = 0;
                }
            }
            //<!--Current Total Pods-->
            
            //<!--Previous Total Pods-->
            $get_total = DCM::getTotalPods($year - 1);
            foreach($get_total->getResult() as $row) {
                $previous_total_pods += $row->pods_num;
                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $previous_total_beans = 0;
                }
            }
            //<!--Previous Total Pods-->

            //<!--Beans Percentage-->
            $difference_beans = $current_total_beans - $previous_total_beans;
            if ($previous_total_beans != 0) {
                $result_diff_beans = $difference_beans / $previous_total_beans;
                $beans_percentage = $result_diff_beans * 100;
            } else {
                $beans_percentage = 0;
            }
            //<!--Beans Percentage-->        
    
            $response = [
                'status' => 200,
                'var1' => $arr1,
                'var2' => $arr2,
                'var3' => $arr3,
                'var4' => $arr4,
                'var5' => $arr5,
                'month' => $current_month,
                'beans_growth' => $beans_percentage
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return $this->response->setJSON($response);
        exit;
    }

    public function get_Tree_Analytics() {
        $arr = [];
        $get_data = DCM::getTreeData();
        $response = [];
        $count = 0;
        
        try {
            foreach ($get_data->getResult() as $row) {
                $arr[] = [
                    "tree_id" => $row->tree_id,
                    "expected_yield" => $row->expected_yield,
                    "tree_variant" => $row->varieties,
                    "expected_harvest" => date('F d, Y',strtotime($row->expected_harvest_date))
                ];
                $count++;
            }
    
            $response = [
                'status' => 200,
                'data' => $arr,
                'count' => $count
            ];
        } catch (\Exception $e) {
            $response = [
                'data' => "Something Went Wrong.",
                'error' => $e
            ];
        }

        return $this->response->setJSON($response);
        exit;
    }

    public function tree_Management() {
        $response = "";
        $farmer_count = 0;
        $tree_data = [];
        $farmer_data = [];
        $unharvest_tree = 0;
        $farmer_name = "";
        $partition = 0;

        try {

            $get_f = DCM::getFarmers(); 
            $farmer_count = $get_f->getNumRows();

            $get_t= DCM::getUnharvestedTrees();
            $unharvest_tree = $get_t->getNumRows();

            if ($unharvest_tree > 0) {
                if ($unharvest_tree > $farmer_count) {
                    if ($farmer_count > 0) {
                        $partition = $unharvest_tree / $farmer_count;
                    }
                    
                    foreach ($get_t->getResult() as $row2) {
                        $tree_data[] = [
                            "tree_id" => $row2->tree_id,
                            "last_fertilize" => date('F d, Y',strtotime($row2->last_fertilize)),
                            "expected_yield" => $row2->expected_yield,
                            //"expected_harvest" => date('F d, Y',strtotime($row2->expected_harvest_date)),
                            "variant" => $row2->varieties
                        ];
                    }

                    foreach ($get_f->getResult() as $row1) {
                        array_push($farmer_data, $row1->firstname . " " . $row1->lastname);
                    }
                } else {
                    $partition = 0;
                    foreach ($get_t->getResult() as $row2) {
                        $tree_data[] = [
                            "tree_id" => $row2->tree_id,
                            "last_fertilize" => date('F d, Y',strtotime($row2->last_fertilize)),
                            "expected_yield" => $row2->expected_yield,
                            "expected_harvest" => date('F d, Y',strtotime($row2->expected_harvest_date)),
                            "variant" => $row2->varieties
                        ];
                    }

                    $count = 1;
                    foreach ($get_f->getResult() as $row1) {
                        if ($count <= $unharvest_tree) {
                            array_push($farmer_data, $row1->firstname . " " . $row1->lastname);
                            $count++;
                        } else {
                            break;
                        }
                    }
                }
    
            }    

            $response = [
                'status' => 200,
                'tree_count' => $unharvest_tree,
                'farmers' => $farmer_count,
                'tree_data' => $tree_data,
                'farmer_data' => $farmer_data,
                'partition' => round($partition)

            ];

        } catch (Exception $e) {
            $response = [
                'status' => 500,
                'tree_count' => $unharvest_tree,
                'farmers' => $farmer_count,
                'tree_data' => $tree_data,
                'farmer_data' => $farmer_data,
                'partition' => round($partition)
            ];
        }

        return $this->response->setJSON($response);
        exit;
    }

    public function refresh_Widget_Data()
    {
        $current_year = date('Y');
        $current_total_beans = 0;
        $previous_total_beans = 0;
        $beans_percentage = 0;
        $current_total_pods = 0;
        $previous_total_pods = 0;
        $pods_percentage = 0;
        $full_total_beans = 0;
        $full_total_pods = 0;
        $total_beans_weight = 0;
        $total_pods_weight = 0;
        $beans_w_percentage = 0;
        $pods_w_percentage = 0;
        $c_growth = 0;
        $response = [];

        try {
            $beans_summation = 0;
            //<!-- Full Total of Pods -->
            $get_total = DCM::getFullTotalPods();
            foreach ($get_total->getResult() as $row) {
                $full_total_pods += $row->pods_num;

                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $beans_summation += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $beans_summation += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $beans_summation += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $beans_summation += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $beans_summation += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $beans_summation = 0;
                }
            }
            //<!-- Full Total of Pods -->

            //<!-- Full Total of Beans -->
            if ($full_total_pods > 0) {
                $full_total_beans = $beans_summation;
            } else {
                $full_total_beans = 0;
            }
            //<!-- Full Total of Beans -->

            //<!--Current Total Pods and Beans-->
            $get_total = DCM::getTotalPods($current_year);
            foreach($get_total->getResult() as $row) {
                $current_total_pods += $row->pods_num;
                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $current_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $current_total_beans = 0;
                }
            }
            //<!--Current Total Pods and Beans-->
            
            //<!--Previous Total Pods and Beans-->
            $get_total = DCM::getTotalPods($current_year - 1);
            foreach($get_total->getResult() as $row) {
                $previous_total_pods += $row->pods_num;
                switch ($row->varieties) {
                    case "BR 25":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "UF-18":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "PBC 123":
                        $this->setAveBeansCount(27);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K2":
                        $this->setAveBeansCount(34);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    case "K9":
                        $this->setAveBeansCount(24);
                        $previous_total_beans += $row->pods_num * $this->getAveBeansCount();
                        break;
                    default:
                        $previous_total_beans = 0;
                }
            }
            //<!--Previous Total Pods and Beans-->

            //<!--Beans Percentage-->
            $difference_beans = $current_total_beans - $previous_total_beans;
            if ($previous_total_beans != 0) {
                $result_diff_beans = $difference_beans / $previous_total_beans;
                $beans_percentage = $result_diff_beans * 100;
            } else {
                $beans_percentage = 0;
            }
            //<!--Beans Percentage-->

            //<!--Pods Percentage-->
            $difference_pods = $current_total_pods - $previous_total_pods;
            if ($previous_total_pods != 0) {
                $result_diff_pods = $difference_pods / $previous_total_pods;
                $pods_percentage = $result_diff_pods * 100;
            } else {
                $pods_percentage = 0;
            }
            //<!--Pods Percentage-->    

            // <-- Pods and Beans Weights -->
            $total_beans_weight = $full_total_beans * $this->getAveBeansWeight();
            $total_pods_weight = $full_total_pods * $this->getAvePodsWeight();
            // <-- Pods and Beans Weights -->

            //<-- Beans Weight Percentage -->
            $previous_beans_weight = $previous_total_beans * $this->getAveBeansWeight();
            $current_weight_beans = $total_beans_weight + $previous_beans_weight;
            $difference_beans_weight = $current_weight_beans - $previous_beans_weight;
            if ($previous_beans_weight != 0) {
                $result_diff_beans_weight = $difference_beans_weight / $previous_beans_weight;
                $beans_w_percentage = $result_diff_beans_weight * 100;
            } else {
                $beans_w_percentage = 0;
            }
            //<-- Beans Weight Percentage -->

            //<-- Pods Weight Percentage -->
            $previous_pods_weight = $previous_total_pods * $this->getAveBeansWeight();
            $current_weight_pods = $total_pods_weight + $previous_pods_weight;
            $difference_pods_weight = $current_weight_pods - $previous_pods_weight;
            if ($previous_pods_weight != 0) {
                $result_diff_pods_weight = $difference_pods_weight / $previous_pods_weight;
                $pods_w_percentage = $result_diff_pods_weight * 100;
            } else {
                $pods_w_percentage = 0;
            }
            //<-- Pods Weight Percentage -->

            $response = [
                'status' => 200,
                'total_beans' => $full_total_beans,
                'total_pods' => $full_total_pods,
                'beans_percentage' => $beans_percentage,
                'pods_percentage' => $pods_percentage,
                'beans_w' => $total_beans_weight,
                'beans_w_percentage' => $beans_w_percentage,
                'pods_w' => $total_pods_weight,
                'pods_w_percentage' => $pods_w_percentage
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'total_beans' => 0,
                'total_pods' => 0,
                'beans_percentage' => 0,
                'pods_percentage' => 0,
                'beans_w' => 0,
                'beans_w_percentage' => 0,
                'pods_w' => 0,
                'pods_w_percentage' => 0
            ];
        }

        return $this->response->setJSON($response);
    }

    public function tree_Yield_Forecast() {
        $arr = [];
        $get_data = DCM::getTreeForecast();
        $response = [];
        $label = "";
        $beans = 0;
        
        try {
            foreach ($get_data->getResult() as $row) {
                $beans = 0;
                if ($row->varieties == "UF-18") {
                    $this->setAveBeansCount(27);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                } else if ($row->varieties == "K9") {
                    $this->setAveBeansCount(24);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                } else if ($row->varieties == "K2") {
                    $this->setAveBeansCount(34);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                } else if ($row->varieties == "PBC 123") {
                    $this->setAveBeansCount(27);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                } else {
                    $this->setAveBeansCount(27);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                }

                $expected_beans_w = $beans * $this->getAveBeansWeight();

                if ($expected_beans_w < 1000) {
                    $label = $expected_beans_w . " g.";
                } else if ($expected_beans_w < 1000000 && $expected_beans_w > 1000) {
                    $newWeight = $expected_beans_w * 0.001;
                    $label = number_format((float)$expected_beans_w, 2, '.', '') . " kg.";
                } else if ($expected_beans_w > 1000000) {
                    $newWeight = $expected_beans_w * 0.0001;
                    $label = number_format((float)$expected_beans_w, 2, '.', '') . " T.";
                }
    
                $arr[] = [
                    $row->tree_id,
                    $row->varieties,
                    $row->expected_yield,
                    $beans,
                    $label,
                    date('F d, Y',strtotime($row->expected_harvest_date))
                ];
            }
    
            $response = [
                'data' => $arr
            ];
        } catch (\Exception $e) {
            $response = [
                'data' => "Something Went Wrong.",
                'error' => $e->getMessage()
            ];
        }

        return $this->response->setJSON($response);
        exit;
    }

    public function tree_Status() {
        $arr = [];
        $get_data = DCM::getTreeStatus();
        $response = [];
        $btn = "";
        
        try {
            foreach ($get_data->getResult() as $row) {
                if ($row->tree_status == "active") {
                    $btn =  "<button type='button' class='btn btn-radius btn-success disabled btn-sm'>
                        <b>Active</b>
                    </button>";
                } else {
                    $btn =  "<button type='button' class='btn btn-radius btn-warning disabled btn-sm'>
                        <b>Inactive</b>
                    </button>
                    <button type='button' id='remove_tree' data-id=".$row->id." class='btn btn-radius btn-danger btn-sm remove_tree'>
                        Delete
                    </button>";
                }

                $arr[] = [
                    $row->tree_id,
                    $row->varieties,
                    date('F d, Y',strtotime($row->modified)),
                    $btn
                ];
            }
    
            $response = [
                'data' => $arr
            ];
        } catch (\Exception $e) {
            $response = [
                'data' => "Something Went Wrong.",
                'error' => $e
            ];
        }

        return $this->response->setJSON($response);
        exit;
    }

    public function generate_Forecast_Graph() {
        $pods_data = [];
        $beans_data = [];
        $year = date('Y');
        $new_month = "";
        $c = 0;
        $pods_sum = 0;
        $beans = 0;

        try {   

            for($i = 1; $i <= 12; $i++) {
                if ($i <= 9) {
                    $new_month = "0" . $i;
                } else {
                    $new_month = $i;
                }
          
                $pods_sum = 0;
                $beans = 0;
                $get_data = DCM::getTreeForecastStats($year, $new_month);

                foreach($get_data->getResult() as $row) {
                    $pods_sum =+ $row->expected_yield;
                    if ($row->expected_yield == "") {
                        array_push($pods_data, 0);
                    } else {
                        $beans = 0;
                        if ($row->varieties == "UF-18") {
                            $this->setAveBeansCount(27);
                            $beans =+ $row->expected_yield * $this->getAveBeansCount(); 
                        } else if ($row->varieties == "K9") {
                            $this->setAveBeansCount(24);
                            $beans =+ $row->expected_yield * $this->getAveBeansCount(); 
                        } else if ($row->varieties == "K2") {
                            $this->setAveBeansCount(34);
                            $beans =+ $row->expected_yield * $this->getAveBeansCount(); 
                        } else if ($row->varieties == "PBC 123") {
                            $this->setAveBeansCount(27);
                            $beans =+ $row->expected_yield * $this->getAveBeansCount(); 
                        } else {
                            $this->setAveBeansCount(27);
                            $beans =+ $row->expected_yield * $this->getAveBeansCount(); 
                        }
                    }
                }
                array_push($pods_data, $pods_sum);
                array_push($beans_data, $beans);
            }

            $arr = [
                'status' => 200,
                'pods_data' => $pods_data,
                'beans_data' => $beans_data
            ];

            return $this->response->setJSON($arr);

        } catch (\Exception $e) {
            $arr = [
                'status' => 500,
                'data' => $e->getMessage()
            ];

            return $this->response->setJSON($arr);
        }
    }

    public function generate_Report() {
        $beans = 0;
        $pods_sum = 0;
        $table_data = "";
        $survey_count = 0;
        $total_pods = 0;
        $list_data = "";
        $total_farmers = 0;

        try {
            $get_data = DCM::get_Forecast_PDF();
            $get_count = DCM::get_Survey_Count();
            $get_total = DCM::get_Added_Pods();
            $get_names = DCM::get_Surveyor_Names();

            $table_data .= <<<EOF
            <tr>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
            </tr>
        EOF;

            $list_data .= <<<EOF
            <tr>
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
            </tr>
        EOF;

            foreach ($get_data->getResult() as $row) {
                $pods_sum = $row->expected_yield;
                if ($row->varieties == "UF-18") {
                    $this->setAveBeansCount(27);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                } else if ($row->varieties == "K9") {
                    $this->setAveBeansCount(24);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                } else if ($row->varieties == "K2") {
                    $this->setAveBeansCount(34);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                } else if ($row->varieties == "PBC 123") {
                    $this->setAveBeansCount(27);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                } else {
                    $this->setAveBeansCount(27);
                    $beans = $row->expected_yield * $this->getAveBeansCount(); 
                }

                $date = date('F d, Y',strtotime($row->expected_harvest_date));

                $table_data .= <<<EOF
                <tr>
                <td>{$pods_sum}</td>
                <td>{$beans}</td>
                <td>{$date}</td>
                </tr>
                EOF;
            }

            foreach ($get_count->getResult() as $row) {
                $survey_count++;
            }

            foreach ($get_total->getResult() as $row) {
                $total_pods =+ $row->expected_yield;
            }

            foreach($get_names->getResult() as $row) {
                $total_farmers++;
                $list_data .= <<<EOF
                <tr>
                <td>{$row->surveyor_name}</td>
                <td>{$row->expected_yield}</td>
                <td>{$row->tree_id}</td>
                </tr>
            EOF;
            }

            $mpdf = new \Mpdf\Mpdf();
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->setAutoBottomMargin = 'stretch';

            $pdfcontent = '<style>
            h3.title {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 30px;
                letter-spacing: 1px;
                word-spacing: 3px;
                margin: 15px 0;
                text-align: center;
                text-transform: uppercase;
            }
    
            table.summary {
                width: 100%;
                text-align: center;
                border-spacing: 13px;
            }
    
            table.summary tr {
                height: 180px;
            }
    
            table.summary td {
                border: 1px solid rgb(139, 139, 139);
                width: 33.33%;
                font-family: "Times New Roman", Georgia, Times, serif;
                font-size: 18px;
                padding: 15px;
                background: #2196F3;
                color: white;
            }
    
            tr.no_bg td {
                background: transparent;
                border: none;
                padding: 0;
            }
    
            tr.no_bg table td {
                border: 1px solid rgb(139, 139, 139);
                padding: 15px;
                background: #2196F3;
            }
    
            table.summary td h3 {
                font-family: Arial, Helvetica, sans-serif;
                font-weight: 800;
                margin-bottom: 0;
            }
    
            table.summary table {
                text-align: center;
                border-spacing: 13px;
                width: 80%;
            }
    
            table.summary table td {
                width: 50%;
            }
    
            table.date {
                border-spacing: 10px;
                
            }
    
            table.date h4 {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 18px;
                margin: 0;
            }
    
            table.date h3 {
                margin: 0;
            }
    
            table.borrowers_table {
                margin-top: 20px;
                width: 100%;
                border-collapse: collapse;
            }
    
            table.borrowers_table tr:nth-child(even) {
                background: rgb(220, 220, 220);
            }
    
            table.borrowers_table td, 
            table.borrowers_table th {
                border: 1px solid rgb(220, 220, 220);
                padding: 10px;
                text-align: center;
            }
    
            table.borrowers_table th {
                background: #2196F3;
                color: white;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: 600;
                font-size: 18px;
            }
    
            table.borrowers_table td {
                font-family: "Times New Roman", Georgia, Times, serif;
                font-size: 15px;
            }
            </style>
            <h3 class="title">Podcast System Forecast Report</h3>
            <table class="date" align="center">
                <tr>
                    <td><h4>Date:</h4></td>
                    <td><h3 style="color: rgb(0, 196, 10);">' . date('M j, Y') . '</h3></td>
                </tr>
            </table>
            <table class="borrowers_table">
                <thead>
                    <tr>
                        <th>Expected Total Pods Qty.</th>
                        <th>Expected Total Beans Qty.</th>
                        <th>Expected Harvest Date</th>
                    </tr>
                </thead>
                <tbody>'
                   . $table_data .
                '</tbody>
            </table>
            <br><br>
            <h2>Daily Farmer\'s Work Output: </h2>
            <ul>
                <li><h4>The total number of trees surveyed by the farmers today is: ' . $survey_count . '</h4></li>
                <li><h4>The total number of added cacaopod today is: ' . $total_pods . '</h4>
            </ul>
            <br>
            <h3>List of Farmer\'s: </h3>
            <table class="borrowers_table">
                <thead>
                    <tr>
                        <th>Surveyor Name</th>
                        <th>Added Cacao Pods</th>
                        <th>Surveyed Tree ID</th>
                    </tr>
                </thead>
                <tbody>'
                   . $list_data .
                '</tbody>
            </table>
            <br>
            <br>
            <h4>Total Farmers Today: ' . $total_farmers . '
            ';
    
            $mpdf->WriteHTML($pdfcontent);
    
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->list_indent_first_level = 0; 
    
            //call watermark content and image
            //$mpdf->SetWatermarkText('etutorialspoint');
            $mpdf->showWatermarkText = true;
            $mpdf->watermarkTextAlpha = 0.1;
    
            $file_name = "DASHBOARD-REPORTS-" . date('Y-m-d') . "-" . rand(10000,99999) . ".pdf";
            //output in browser
            $mpdf->Output(WRITEPATH . "dashboardLogs/" . $file_name . "", 'F');	
    
            $arr = [
                "response" => 200,
                "file_name" => $file_name
            ];

            $data = [
                'response' => $arr
            ];

            return json_encode($arr);
        } catch (\Exception $e) {
            $response = [
                'data' => "Something Went Wrong.",
                'error' => $e->getMessage()
            ];
        }
    }

    public function remove_Tree() {
        $tree_id = $this->request->getVar('tree_id');

        try {
            $update = DCM::remove_Tree($tree_id);

            $arr = [
                'status' => 200
            ];

            return $this->response->setJSON($arr);
        } catch (\Exception $e) {
            $arr = [
                'status' => 500
            ];

            return $this->response->setJSON($arr);
        }
    }

    public function get_File() {
        $file =  $this->request->getVar('file');
        $filepath = WRITEPATH . 'dashboardLogs/' . $file;;

        $mime = mime_content_type($filepath);
        header('Content-Length: ' . filesize($filepath));
        header("Content-Type: $mime");
        header('Content-Disposition: inline; filename="' . $filepath . '";');
        readfile($filepath);
        exit();
    }
}