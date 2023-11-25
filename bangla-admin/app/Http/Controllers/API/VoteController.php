<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function getVote(): \Illuminate\Http\JsonResponse
    {
        $result = [];
        $votes = Vote::where('status',1)->orderBy('order','ASC')->get();
        foreach($votes as $item)
        {
            $result[] = $this->getResult($item->id);
        }
        

        return response()->json($result);
    }

    public function getResult($id = 0): array
    {
        if ($id == 0) {
            $vote = Vote::orderBy('id', 'DESC')->first();
        } else {
            $vote = Vote::find($id);
        }

        $totalVote = $vote->yes + $vote->no + $vote->no_comments;
        $yes = $totalVote ? ($vote->yes * 100) / $totalVote : 0;
        $no = $totalVote ? ($vote->no * 100) / $totalVote : 0;
        $noComments = $totalVote ? ($vote->no_comments * 100) / $totalVote : 0;

        return [
            'id' => $vote->id,
            'topic' => $vote->description,
            'image' => $vote->image,
            'yes' => $yes,
            'no' => $no,
            'no_comments' => $noComments
        ];
    }

    public function increseVote($voteObj, $vote)
    {
        if ($voteObj) {
            switch ($vote) {
                case 1:
                    $voteObj->yes = $voteObj->yes + 1;
                    break;
                case 2:
                    $voteObj->no = $voteObj->no + 1;
                    break;
                case 3:
                    $voteObj->no_comments = $voteObj->no_comments + 1;
                    break;
            }

            $voteObj->save();
        }
    }

    public function decreaseVote($voteObj, $vote)
    {
        if ($voteObj) {
            switch ($vote) {
                case 1:
                    $voteObj->yes = $voteObj->yes - 1;
                    break;
                case 2:
                    $voteObj->no = $voteObj->no - 1;
                    break;
                case 3:
                    $voteObj->no_comments = $voteObj->no_comments - 1;
                    break;
            }

            $voteObj->save();
        }
    }

    public function giveVote($id, $vote): \Illuminate\Http\JsonResponse
    {
        $voteObj = Vote::find($id);
        $this->increseVote($voteObj, $vote);
        $result = $this->getResult($voteObj->id);
        return response()->json($result);
    }

    public function changeVote($id, $previous, $new)
    {
        if($previous == $new){
            $result = $this->getResult($id);
            return response()->json($result);
        }

        $voteObj = Vote::find($id);
        $this->decreaseVote($voteObj, $previous);
        $this->increseVote($voteObj, $new);
        $result = $this->getResult($voteObj->id);
        return response()->json($result);

    }
}
