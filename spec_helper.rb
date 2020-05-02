require 'coveralls'
Coveralls.wear!
RSpec.configure do |config|

config.expect_with :respec do |expectations|
  expectation.include_chain_clauses_in_custom_matcher_descriptions = true
 end
 config.mock_with : rspecdo |mocks|
  mocks.verify_partial_doubles = true
 end
 config.shared_context-metadata_behavior = :apply_to_host_groups
end
