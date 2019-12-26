    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-12">
                    <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Ảnh</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Tag</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Tiêu Đề</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Nội dung</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Hành Động</th></tr>
                        </thead>
                        <tbody>
                        @if (isset($Listsearch) && count($Listsearch) >0)
                            @foreach($Listsearch as $ser)
                                <tr role="row" class="odd">
                                    <td>{{ $ser->image_name }}</td>
                                    <td class="sorting_1">{{ $ser->urlconcept }}</td>
                                    <td>{{ $ser->title }}</td>
                                    <td>{{ $ser->content }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('admin/concept')}}/{{ $ser->urlconcept }}/edit" class="btn btn-default bg-purple">
                                                <span>Edits</span>
                                            </a>
                                            <form action="{{ url('admin/concept')}}/{{ $ser->urlconcept }}" method="POST">
                                                 <input type="hidden" name="_method" value="DELETE">
                                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                               <input type="submit" class="btn btn-danger" value="Delete"/>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>