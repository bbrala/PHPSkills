<?php
namespace Moserware\Skills\FactorGraphs;

require_once(dirname(__FILE__) . "../Guard.php");
require_once(dirname(__FILE__) . "../HashMap.php");

use Moserware\Skills\Guard;
use Moserware\Skills\HashMap;

class Factor
{
    private $_messages = array();
    private $_messageToVariableBinding;

    private $_name;
    private $_variables = array();

    protected function __construct($name)
    {
        $this->_name = "Factor[" . $name . "]";
        $this->_messagesToVariableBinding = new HashMap();
    }

    /// Returns the log-normalization constant of that factor
    public function getLogNormalization()
    {
        return 0;
    }

    /// Returns the number of messages that the factor has
    public function getNumberOfMessages()
    {
        return count($this->_messages);
    }

    protected function getVariables()
    {
        return $this->_variables;
    }

    protected function getMessages()
    {
        return $this->_messages;
    }

    /// Update the message and marginal of the i-th variable that the factor is connected to
    public function updateMessageIndex($messageIndex)
    {
        Guard::argumentIsValidIndex($messageIndex, count($this->_messages), "messageIndex");
        return $this->updateMessageVariable($this->_messages[$messageIndex], $this->_messageToVariableBinding->getValue($messageIndex));
    }

    protected function updateMessageVariable($message, $variable)
    {
        throw new Exception();
    }

    /// Resets the marginal of the variables a factor is connected to
    public function resetMarginals()
    {
        foreach ($this->_messageToVariableBindings->getAllValues() as $currentVariable)
        {
            $currentVariable->resetToPrior();
        }
    }

    /// Sends the ith message to the marginal and returns the log-normalization constant
    public function sendMessageIndex($messageIndex)
    {
        Guard::argumentIsValidIndex($messageIndex, count($_messages), "messageIndex");

        $message = $this->_messages[$messageIndex];
        $variable = $this->_messageToVariableBinding->getValue($message);
        return $this->sendMessageVariable($message, $variable);
    }

    protected abstract function sendMessageVariable($message, $variable);

    public abstract function createVariableToMessageBinding($variable);

    protected function createVariableToMessageBinding($variable, $message)
    {
        $index = count($this->_messages);
        $this->_messages[] = $message;
        $this->_messageToVariableBinding->setValue($message) = $variable;
        $this->_variables[] = $variable;
        return $message;
    }

    public function __toString()
    {
        return ($this->_name != null) ? $this->_name : base::__toString();
    }
}

?>