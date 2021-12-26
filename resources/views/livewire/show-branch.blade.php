<div>
    <table id="" class="table  branchList">
        <tbody>
        @if(!empty($branches))
            @foreach($branches->where('parent_id',0) as $key=>$branch)
                @include('org::students._single_branch',['branch'=>$branch,'level'=>1])
            @endforeach
        @endif
        </tbody>
    </table>

    @push('js')
        <script>
            $(document).on("click", ".activeBranchCode", function () {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active');
                }
                // $('.preloader').fadeIn('slow');

            });
        </script>
    @endpush
</div>
