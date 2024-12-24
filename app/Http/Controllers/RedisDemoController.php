<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class RedisDemoController extends Controller
{
    // 1. Set a key-value pair in Redis
    public function setRedis()
    {
        Redis::set('name', 'Laravel');
        return response()->json(['message' => 'Key "name" set in Redis']);
    }

    // 2. Get a value from Redis by key
    public function getRedis()
    {
        $value = Redis::get('name');
        
        if ($value) {
            return response()->json(['message' => "The value of 'name' is: $value"]);
        }

        return response()->json(['message' => "Key 'name' does not exist in Redis"]);
    }

    // 3. Delete a key from Redis
    public function deleteRedis()
    {
        $deleted = Redis::del('name');
        
        if ($deleted) {
            return response()->json(['message' => 'Key "name" deleted from Redis']);
        }

        return response()->json(['message' => 'Key "name" does not exist']);
    }

    // 4. Set a key with an expiration time (in seconds)
    public function setWithExpiration()
    {
        Redis::setex('temporary_key', 30, 'This is temporary');
        return response()->json(['message' => 'Key "temporary_key" set with expiration of 30 seconds']);
    }

    // 5. Check if a key exists
    public function checkIfExists()
    {
        $exists = Redis::exists('temporary_key');
        
        if ($exists) {
            return response()->json(['message' => 'Key "temporary_key" exists']);
        }

        return response()->json(['message' => 'Key "temporary_key" does not exist']);
    }

    // 6. Increment the value of a key
    public function incrementValue()
    {
        Redis::set('counter', 10);
        Redis::incr('counter');
        $newValue = Redis::get('counter');
        return response()->json(['message' => "Incremented counter: $newValue"]);
    }

    // 7. Decrement the value of a key
    public function decrementValue()
    {
        Redis::set('counter', 10);
        Redis::decr('counter');
        $newValue = Redis::get('counter');
        return response()->json(['message' => "Decremented counter: $newValue"]);
    }

    // 8. Push an element to a Redis list
    public function pushToList()
    {
        Redis::rpush('colors', 'red');
        Redis::rpush('colors', 'green');
        Redis::rpush('colors', 'blue');
        return response()->json(['message' => 'Pushed elements to list "colors"']);
    }

    // 9. Get all elements of a Redis list
    public function getList()
    {
        $colors = Redis::lrange('colors', 0, -1);
        return response()->json(['message' => 'List "colors":', 'data' => $colors]);
    }

    // 10. Pop an element from a Redis list
    public function popFromList()
    {
        $color = Redis::rpop('colors');
        return response()->json(['message' => 'Popped element from list "colors":', 'data' => $color]);
    }

    // 11. Add members to a Redis set
    public function addToSet()
    {
        Redis::sadd('fruits', 'apple');
        Redis::sadd('fruits', 'banana');
        Redis::sadd('fruits', 'orange');
        return response()->json(['message' => 'Added members to set "fruits"']);
    }

    // 12. Get all members of a Redis set
    public function getSet()
    {
        $fruits = Redis::smembers('fruits');
        return response()->json(['message' => 'Set "fruits":', 'data' => $fruits]);
    }

    // 13. Check if a member exists in a Redis set
    public function isMemberOfSet()
    {
        $isMember = Redis::sismember('fruits', 'apple');
        
        if ($isMember) {
            return response()->json(['message' => 'Apple is a member of the "fruits" set']);
        }

        return response()->json(['message' => 'Apple is NOT a member of the "fruits" set']);
    }

    // 14. Add a field-value pair to a Redis hash
    public function addToHash()
    {
        Redis::hset('user:1000', 'name', 'John Doe');
        Redis::hset('user:1000', 'email', 'john@example.com');
        return response()->json(['message' => 'Added data to hash "user:1000"']);
    }

    // 15. Get all fields and values from a Redis hash
    public function getHash()
    {
        $userData = Redis::hgetall('user:1000');
        return response()->json(['message' => 'Hash "user:1000":', 'data' => $userData]);
    }

    // 16. Set a value in a Redis sorted set
    public function addToSortedSet()
    {
        Redis::zadd('scores', 100, 'John');
        Redis::zadd('scores', 90, 'Alice');
        Redis::zadd('scores', 95, 'Bob');
        return response()->json(['message' => 'Added values to sorted set "scores"']);
    }

    // 17. Get the members of a sorted set
    public function getSortedSet()
    {
        $scores = Redis::zrange('scores', 0, -1, 'WITHSCORES');
        return response()->json(['message' => 'Sorted set "scores":', 'data' => $scores]);
    }

    // 18. Get the rank of a member in a sorted set
    public function getSortedSetRank()
    {
        $rank = Redis::zrank('scores', 'Bob');
        return response()->json(['message' => 'Rank of Bob in sorted set "scores":', 'data' => $rank]);
    }

    // 19. Remove a member from a sorted set
    public function removeFromSortedSet()
    {
        Redis::zrem('scores', 'Alice');
        return response()->json(['message' => 'Removed Alice from sorted set "scores"']);
    }

    // 20. Get the range of elements in a sorted set by score
    public function getSortedSetByScore()
    {
        $scores = Redis::zrangebyscore('scores', 90, 100);
        return response()->json(['message' => 'Members in sorted set "scores" with score between 90 and 100:', 'data' => $scores]);
    }

    // 21. Increment the score of a member in a sorted set
    public function incrementSortedSetScore()
    {
        Redis::zincrby('scores', 10, 'John');
        $score = Redis::zscore('scores', 'John');
        return response()->json(['message' => 'Incremented score of John in sorted set "scores":', 'data' => $score]);
    }

    // 22. Push to the left side of a Redis list
    public function pushToLeftList()
    {
        Redis::lpush('fruits', 'grape');
        return response()->json(['message' => 'Pushed grape to the left side of list "fruits"']);
    }

    // 23. Get the length of a Redis list
    public function getListLength()
    {
        $length = Redis::llen('fruits');
        return response()->json(['message' => 'Length of list "fruits":', 'data' => $length]);
    }

    // 24. Get a range of elements from a Redis list
    public function getListRange()
    {
        $fruits = Redis::lrange('fruits', 0, 2);
        return response()->json(['message' => 'Range from list "fruits":', 'data' => $fruits]);
    }

    // 25. Set multiple fields in a Redis hash
    public function setMultipleHashFields()
    {
        Redis::hmset('user:1001', ['name' => 'Jane', 'email' => 'jane@example.com']);
        return response()->json(['message' => 'Set multiple fields in hash "user:1001"']);
    }

    // 26. Get multiple fields from a Redis hash
    public function getMultipleHashFields()
    {
        $userData = Redis::hmget('user:1001', ['name', 'email']);
        return response()->json(['message' => 'Fields from hash "user:1001":', 'data' => $userData]);
    }

    // 27. Get the keys of a Redis hash
    public function getHashKeys()
    {
        $keys = Redis::hkeys('user:1001');
        return response()->json(['message' => 'Keys of hash "user:1001":', 'data' => $keys]);
    }

    // 28. Get the length of a Redis hash
    public function getHashLength()
    {
        $length = Redis::hlen('user:1001');
        return response()->json(['message' => 'Length of hash "user:1001":', 'data' => $length]);
    }

    // 29. Set a Redis key as a bitmap
    public function setBitmap()
    {
        Redis::setbit('bitmap', 100, 1);
        $bit = Redis::getbit('bitmap', 100);
        return response()->json(['message' => 'Set a bitmap value at index 100:', 'data' => $bit]);
    }

    // 30. Get the number of set bits in a Redis bitmap
    public function getBitmapCount()
    {
        $count = Redis::bitcount('bitmap');
        return response()->json(['message' => 'Number of set bits in bitmap:', 'data' => $count]);
    }

    // 31. Publish a message to a Redis channel
    public function publishMessage()
    {
        Redis::publish('my_channel', 'Hello, Redis!');
        return response()->json(['message' => 'Message published to "my_channel"']);
    }

    // 32. Subscribe to a Redis channel
    public function subscribeToChannel()
    {
        Redis::subscribe(['my_channel'], function ($message) {
            return response()->json(['message' => 'Message received from channel:', 'data' => $message]);
        });
    }

    // 33. Start a Redis transaction
    public function startTransaction()
    {
        Redis::multi();
        Redis::set('trans_key', 'transaction');
        Redis::set('trans_key2', 'value');
        Redis::exec();
        return response()->json(['message' => 'Transaction executed']);
    }

    // 34. Use Redis Pipelining (batch commands)
    public function usePipelining()
    {
        $responses = Redis::pipeline(function ($pipe) {
            $pipe->set('pipelining_key1', 'value1');
            $pipe->set('pipelining_key2', 'value2');
        });

        return response()->json(['message' => 'Pipelining executed', 'data' => $responses]);
    }

    // 35. Get the time to live (TTL) of a Redis key
    public function getTTL()
    {
        $ttl = Redis::ttl('temporary_key');
        return response()->json(['message' => 'TTL of "temporary_key":', 'data' => $ttl]);
    }

    // 36. Reset the TTL of a Redis key
    public function resetTTL()
    {
        Redis::expire('temporary_key', 60);
        return response()->json(['message' => 'TTL of "temporary_key" reset to 60 seconds']);
    }

    // 37. Get the keys that match a pattern
    public function getKeysByPattern()
    {
        $keys = Redis::keys('*');
        return response()->json(['message' => 'Keys matching pattern "*":', 'data' => $keys]);
    }

    // 38. Check if a Redis key is expired
    public function checkIfExpired()
    {
        $isExpired = Redis::ttl('temporary_key') == -2;
        return response()->json(['message' => $isExpired ? 'Key has expired' : 'Key is still alive']);
    }

    // 39. Store and retrieve a Redis list from a file (using Redis's `dump` and `restore`)
    public function dumpAndRestore()
    {
        Redis::rpush('list', 'apple', 'banana');
        $dump = Redis::dump('list');
        Redis::restore('new_list', 0, $dump);
        return response()->json(['message' => 'List restored from dump']);
    }

    // 40. Create a Redis HyperLogLog and add elements
    public function hyperLogLog()
    {
        Redis::pfadd('unique_items', 'apple');
        Redis::pfadd('unique_items', 'banana');
        $count = Redis::pfcount('unique_items');
        return response()->json(['message' => 'Unique items count in HyperLogLog:', 'data' => $count]);
    }

    // 41. Create a Redis Geospatial Index (using latitude and longitude)
    public function geospatialAdd()
    {
        Redis::geoadd('locations', 13.361389, 38.115556, 'Catania');
        return response()->json(['message' => 'Geospatial data added for "Catania"']);
    }

    // 42. Get the distance between two points (geo)
    public function geospatialDistance()
    {
        $distance = Redis::geodist('locations', 'Catania', 'Palermo', 'km');
        return response()->json(['message' => 'Distance between "Catania" and "Palermo":', 'data' => $distance . ' km']);
    }

    // 43. Get the radius of a Redis Geospatial area
    public function geospatialRadius()
    {
        $locations = Redis::georadius('locations', 15.087269, 37.502669, 100, 'km');
        return response()->json(['message' => 'Locations within 100 km radius:', 'data' => $locations]);
    }

    // 44. Add an item to a Redis Sorted Set and get top N items
    public function getTopSortedSet()
    {
        Redis::zadd('rankings', 100, 'John');
        Redis::zadd('rankings', 90, 'Alice');
        $topRankings = Redis::zrevrange('rankings', 0, 1);
        return response()->json(['message' => 'Top 2 members in sorted set "rankings":', 'data' => $topRankings]);
    }

    // 45. Remove an item from a sorted set
    public function removeFromSortedSetExample()
    {
        Redis::zrem('rankings', 'Alice');
        return response()->json(['message' => 'Removed Alice from sorted set "rankings"']);
    }

    // 46. Clear all Redis keys
    public function clearAllKeys()
    {
        Redis::flushall();
        return response()->json(['message' => 'Cleared all keys in Redis']);
    }

    // 47. Redis pipelining with Redis hash
    public function pipelineWithHash()
    {
        $responses = Redis::pipeline(function ($pipe) {
            $pipe->hset('user:1002', 'name', 'Tom');
            $pipe->hset('user:1002', 'email', 'tom@example.com');
        });

        return response()->json(['message' => 'Hash pipelined updates executed', 'data' => $responses]);
    }

    // 48. Using Redis MSET for setting multiple keys
    public function msetRedis()
    {
        Redis::mset(['key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3']);
        return response()->json(['message' => 'Multiple keys set using MSET']);
    }

    // 49. Using Redis MGET for getting multiple keys
    public function mgetRedis()
    {
        $values = Redis::mget(['key1', 'key2', 'key3']);
        return response()->json(['message' => 'Retrieved multiple keys using MGET', 'data' => $values]);
    }

    // 50. Redis ZREMRANGEBYRANK to remove elements from a sorted set by rank
    public function removeByRankFromSortedSet()
    {
        Redis::zremrangebyrank('rankings', 1, 1);
        return response()->json(['message' => 'Removed element at rank 1 from sorted set']);
    }

}
