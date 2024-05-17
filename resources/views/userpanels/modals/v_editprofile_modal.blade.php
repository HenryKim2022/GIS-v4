<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="editProfileModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="backDropModalTitle">Edit MyProfile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="col-md-12 col-md-6 mb-4 text-center mt-3">
                        <h3 class=""><u class="cust-u">{{ env('APP_ALIAS') }}</u></h3>
                    </div>
                    <div class="row">
                        <!-- Group Logo  -->
                        <div class="col-xl-12 col-md-6 mb-4 justify-content-center">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5 mr-1 Group3Logo">
                                            <table>
                                                <tr>
                                                    <td
                                                        class="d-flex align-content-sm-between justify-content-center align-middle">
                                                        <img src="{{ asset('public/img/app_logo.ico') }}" alt="AppLogo"
                                                            style="height: 83%; width: 62%">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="text-center text-xs font-weight-bold text-uppercase mb-1 mt-1 justify-content-center"
                                                            style="color:#f6503b; font-size: 0.8rem;">
                                                            <a><b>{{ env('APP_INSTITUTION') }}</b></a>
                                                            <div
                                                                class="text-center text-xs font-weight-lighter text-uppercase mb-1 mt-1">
                                                                <a><i>{{ env('APP_PURPOSE') }}</i></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                        <div class="col-7">
                                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                            <div class="text-md text-green font-weight-bold text-uppercase mb-1">
                                                <a class="text-orange">
                                                    Made By:
                                                </a>
                                            </div>

                                            {{-- <style>
                                                    .li-mem {
                                                        font-size: small;
                                                    }
                                                    </style> --}}

                                            @php
                                                $groupMembersJson = env('GROUP_MEMBER');
                                                $groupMembers = json_decode($groupMembersJson, true);
                                            @endphp
                                            @if (is_array($groupMembers))
                                                <div class="cust-ul pl-0 ml-4 grad-txt-2 text-md">
                                                    <div class="row">
                                                        @foreach ($groupMembers as $member)
                                                            <span class="li-mem" style="font-size: 0.8rem;">
                                                                <i class="cust-j mdi mdi-drama-masks mdi-24px"></i>
                                                                <i
                                                                    class="fa-duotone mdi mdi-arrow-expand-right mdi-12px"></i>
                                                                {{ $member[0] }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div> --}}
        </form>
    </div>
</div>


<!-- / CONTENT: EDIT PROFILE -->
