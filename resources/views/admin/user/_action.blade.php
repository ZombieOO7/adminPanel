<a href="{{route('admin.user.create',['uuid'=>@$user->uuid])}}" class="edit" title="Edit"><span class="fas fa-pen"></span></a>
<a href="javascript:;" data-url="{{route('admin.user.delete',['uuid'=>@$user->uuid])}}" class="text-danger delete" title="Delete"><span class="fas fa-trash"></span></a>
