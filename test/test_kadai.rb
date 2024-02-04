require 'net/http'
require 'json'
require 'time'

BASE_URL = 'http://challenge.z2o.cloud'
CHALLENGE_ENDPOINT = '/challenges'
NICKNAME = 'yoshida'

def start_challenge
  uri = URI("#{BASE_URL}#{CHALLENGE_ENDPOINT}?nickname=#{NICKNAME}")
  response = Net::HTTP.post(uri, nil)
  
  if response.is_a?(Net::HTTPSuccess)
    challenge_id = JSON.parse(response.body)['id']
    return challenge_id
  else
    puts "Error starting challenge: #{response.body}"
    return nil
  end
end

def execute_call(challenge_id)
  uri = URI("#{BASE_URL}#{CHALLENGE_ENDPOINT}")
  request = Net::HTTP::Put.new(uri)
  request['X-Challenge-Id'] = challenge_id
  
  begin
    response = Net::HTTP.start(uri.hostname, uri.port) do |http|
      http.request(request)
    end
    
    if response.is_a?(Net::HTTPSuccess)
      return response
    else
      puts "Error executing call: #{response.body}"
      return nil
    end
  rescue StandardError => e
    puts "An error occurred during the HTTP request: #{e.message}"
    return nil
  end
end

def main
  challenge_id = start_challenge
  if challenge_id
    loop do
      response = execute_call(challenge_id)
      if response.nil?
        puts 'Exiting due to an error.'
        break
      end
      
      result = JSON.parse(response.body)
      if result && result['result'] && result['result']['url']
        puts 'Challenge succeeded!'
        puts "URL: #{result['result']['url']}"
        break
      end
      
      sleep_time = ((result['actives_at'] || Time.now.to_i * 1000) - (result['called_at'] || 0)).to_f / 1000
      sleep sleep_time if sleep_time > 0
    end
  end
end

main if __FILE__ == $0
