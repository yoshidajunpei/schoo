require 'net/http'
require 'json'
require 'time'

BASE_URL = 'http://challenge.z2o.cloud'
CHALLENGE_ENDPOINT = '/challenges'
NICKNAME = 'yoshida'

def start_challenge
  uri = URI("#{BASE_URL}#{CHALLENGE_ENDPOINT}?nickname=#{NICKNAME}")
  response = Net::HTTP.post(uri, nil)
  JSON.parse(response.body)['id'] if response.is_a?(Net::HTTPSuccess)
end

def execute_call(challenge_id)
  uri = URI("#{BASE_URL}#{CHALLENGE_ENDPOINT}")
  response = Net::HTTP.start(uri.host, uri.port) do |http|
    request = Net::HTTP::Put.new(uri)
    request['X-Challenge-Id'] = challenge_id
    http.request(request)
  end
  response if response.is_a?(Net::HTTPSuccess)
end

def main
  challenge_id = start_challenge
  if challenge_id
    loop do
      response = execute_call(challenge_id)
      break unless response

      result = JSON.parse(response.body)
      url = result.dig('result', 'url')
      if url
        puts 'Challenge succeeded!'
        puts "URL: #{url}"
        break
      end

      sleep_time = [((result['actives_at'] || Time.now.to_i * 1000) - (result['called_at'] || 0)) / 1000, 0].max
      sleep sleep_time
    end
  end
end

main if __FILE__ == $0
