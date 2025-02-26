@extends('admin.main')

@section('content')

   <table>
      <thead>
        <tr>
            <th style="width: 50px; padding-left: 15px;">ID</th>
            <th>Hình ảnh</th>
            <th>Name</th>
            <th>Menu Parent</th>
            <th>Description</th>
            <th>Content</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 130px">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
      
        <tr>
            <td style="width: 50px; padding-left: 15px;">{{ $menu->id }}"</td>
            <td> 
                <div class="how-itemcart1">
                    <a href="{{ $menu->thumb }}" target="_blank" > 
                    <img src="{{ $menu->thumb }}" width="100px" target="_blank" alt="IMG">
                </div>
            </td>
            <td> {{ $menu->name }}</td>
            <td> {{ $parentName }}</td>
            <td> {{ $menu->description }}</td>
            <td style="max-width: 200px;">{{ $menu->content }}</td>
            <td>{!! \App\Helpers\Helper::active($menu->active)  !!}</td>
            <td>{{ $menu->updated_at }}</td>
        </tr>

      </tbody>
   </table>
@endsection

