<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use php\net\Socket; // Import the Socket class


class RFIDController extends Controller
{
    public function connectRFID(Request $request){
        $raspberry_ip = "192.168.30.51";
        $port = "21567";
        $cmd = "RfidOn";
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        try {
            $sockconnect = socket_connect($socket, $raspberry_ip, $port);
            
        } catch (SocketException $e) {
            // Handle connection error
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to connect to socket: ' . $e->getMessage()
            ]);
        }

        // Send the command
        try {
            socket_write($socket, $cmd, strlen($cmd));

            // Close the socket connection
            socket_close($socket);

            return response()->json([
                'status' => 'success',
                'message' => 'Message sent to socket successfully'
            ]);
        } catch (SocketException $e) {
            // Handle message sending error
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message to socket: ' . $e->getMessage()
            ]);
        }
    }
}
