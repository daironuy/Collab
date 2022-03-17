<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\MessageModel;
use App\Models\UnreadMessageModel;

class Messages extends BaseController
{
    public function index()
    {
        return view('Messages/index');
    }

    public function getOtherDepartments()
    {
        $userId = session()->get('auth')['id'];
        $currentDepartmentId = session()->get('auth')['department_id'];

        $otherDepartments =
            (new DepartmentModel())
                ->where('id!=' . session()->get('auth')['department_id'])
                ->findAll();

        foreach ($otherDepartments as &$department) {
            $unreadMessageData = (new UnreadMessageModel())
                ->where('user_id', $userId)
                ->where('department_id', $department['id'])
                ->first()
            ;

            $department['unread_messages_count'] = (new MessageModel())
                ->select('COUNT(messages.id) as unread_messages_count')
                ->join('users', 'messages.user_id=users.id')
                ->where('((' .
                    '   users.department_id=' . $currentDepartmentId . ' AND messages.department_id=' . $department['id'] . '' .
                    ') OR (' .
                    '   users.department_id=' . $department['id'] . ' AND messages.department_id=' . $currentDepartmentId . '' .
                    ')) '.($unreadMessageData!=null?'AND messages.id>'.$unreadMessageData['last_read_message_id']:'')
                )
                ->findAll()[0]['unread_messages_count'];
            ;
        }

        echo json_encode($otherDepartments);
        exit();
    }

    public function add()
    {
        (new MessageModel())
            ->save([
                'user_id' => session()->get('auth')['id'],
                'department_id' => $_POST['department_id'],
                'message' => encrypt($_POST['message']),
            ]);
    }

    public function getMessage($departmentId = 0)
    {
        $currentDepartmentId = session()->get('auth')['department_id'];

        $messages = (new MessageModel())
            ->select('messages.*,' .
                'departments.name as user_department_name,' .
                'positions.name as user_position_name,' .
                'users.first_name,' .
                'users.last_name'
            )
            ->join('users', 'messages.user_id=users.id')
            ->join('positions', 'positions.id=users.position_id')
            ->join('departments', 'departments.id=users.department_id')
            ->where('(' .
                '   users.department_id=' . $currentDepartmentId . ' AND messages.department_id=' . $departmentId . '' .
                ') OR (' .
                '   users.department_id=' . $departmentId . ' AND messages.department_id=' . $currentDepartmentId . '' .
                ')'
            )
            ->findAll()
        ;

        if(count($messages)>0){
            $this->updateLastMessageRead($departmentId, $messages[count($messages)-1]['id']);
        }

        foreach ($messages as &$message){
            $message['message'] = decrypt($message['message']);
        }

        echo json_encode([
            'success' => 0,
            'message' => '',
            'data' => $messages
        ]);
        exit();
    }

    public function updateLastMessageRead($departmentId, $messageId)
    {
        $userId = session()->get('auth')['id'];

        $isLastMessageFound = (new UnreadMessageModel())
            ->where('user_id', $userId)
            ->where('department_id', $departmentId)
            ->where('last_read_message_id', $messageId)
            ->first();

        if($isLastMessageFound==null){
            (new UnreadMessageModel())
                ->where('user_id', $userId)
                ->where('department_id', $departmentId)
                ->delete();

            (new UnreadMessageModel())
                ->save([
                    'user_id'=>$userId,
                    'department_id'=>$departmentId,
                    'last_read_message_id'=>$messageId,
                ]);
        }
    }
}
