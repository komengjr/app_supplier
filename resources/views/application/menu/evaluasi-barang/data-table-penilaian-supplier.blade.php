 <table id="example" class="table table-striped" style="width:100%">
     <thead class="bg-200 text-700 border border-primary">
         <tr>
             <th class="text-center" rowspan="2">No</th>
             <th class="text-center" rowspan="2">Nama Supplier</th>
             <th rowspan="2" class="text-center">Action</th>
         </tr>
         <tr>
             @foreach ($cat as $cats)
             <th>{{ $cats->t_penilaian_cat_name }}</th>
             @endforeach
         </tr>
     </thead>
     <tbody>
         @php
         $no = 1;
         @endphp

     </tbody>
 </table>

 <script>
     new DataTable('#example', {
         responsive: true
     });
 </script>
