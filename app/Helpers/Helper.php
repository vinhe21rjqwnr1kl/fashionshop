<?php
namespace App\Helpers;

use Illuminate\Support\Str;


class Helper
{
    public static function menu($menus, $parent_id = 0, $char = ''){
        $html = '';

        foreach($menus as $key => $menu){
            if($menu->parent_id == $parent_id){
                $html .= '
                    <tr>
                        <td style="width: 50px; padding-left: 15px;">' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id . '">
                                <i class="fas fa-edit"></i>
                            </a>
                              <a class="btn btn-primary btn-sm" href="/admin/menus/detail/' . $menu->id . '">
                                 <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onClick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char .'|--');
            }
        }
        return $html;
    }

    public static function active($active = 0) : string{
        return $active == 0 ? '<span class="badge badge-danger btn-xs"> NO </span>' : '<span class="badge badge-success btn-xs"> YES </span>';
    }
    
    public static function menus($menus, $parent_id = 0): string{
        $html = '';
        foreach($menus as $key => $menu){
            if($menu->parent_id == $parent_id){
                $html .= '
                <li>
                     <a href="/danh-muc/'. $menu->id . '-'. Str::slug($menu->name, '-')  .' .html">
                            '. $menu->name .'
                     </a>';
                     unset($menus[$key]);
                if(self::isChild($menus, $menu->id)){
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }
                $html .=' </li>
                ';
            }
        }
        return $html;
    }

    public static function isChild($menus, $id): bool{
        foreach($menus as $k => $menu){
            if($menu->parent_id == $id){
               return true;
            }
        }
        return false;
    }

    public static function price($price = 0, $price_sale = 0){
        $formattedPrice = $price != 0 ? number_format($price) . ' đ' : null;
        $formattedPriceSale = $price_sale != 0 ? number_format($price_sale) . ' đ' : null;
    
        // Xây dựng chuỗi kết quả
        if ($formattedPrice && $formattedPriceSale) {
            return "<span style='text-decoration: line-through;'>$formattedPrice</span> <span style='color: red;'>$formattedPriceSale</span>";
        } elseif ($formattedPrice) {
            return $formattedPrice;
        } elseif ($formattedPriceSale) {
            return $formattedPriceSale;
        }
        
        return '<a href="/contact">Liên Hệ</a>';
    }
    
}