<?php

class CallResult
{
    /**
     * The stdout stream
     *
     * @var resource
     */
    protected $stdOut;

    /**
     * True if there is a stdout
     *
     * @var boolean
     */
    protected $hasStdOut;

    /**
     * The stderr stream
     *
     * @var resource
     */
    protected $stdErr;

    /**
     * True if there is a stderr
     *
     * @var boolean
     */
    protected $hasStdErr;

    /**
     * The return code
     *
     * @var integer
     */
    protected $returnCode;

    /**
     * Reference to the call that resulted in this result
     *
     * @var Call
     */
    protected $cliCall;

    /**
     * Creates a new result container for a CLI call
     *
     * @param   Call       $cliCall       Reference to the call that resulted in this result
     * @param   resource   $stdOut        The stdout stream
     * @param   resource   $stdErr        The stderr stream
     * @param   integer    $returnCode    The return code
     */
    public function __construct(Call $cliCall, $stdOut, $stdErr, $returnCode)
    {
        // @todo is there a better way to determine if a stream contains data?
        fseek($stdOut, 0, SEEK_END);
        $hasStdOut  = (ftell($stdOut) > 0);
        fseek($stdOut, 0, SEEK_SET);

        // @todo is there a better way to determine if a stream contains data?
        fseek($stdErr, 0, SEEK_END);
        $hasStdErr  = (ftell($stdErr) > 0);
        fseek($stdErr, 0, SEEK_SET);

        $this->cliCall      = $cliCall;
        $this->stdOut       = $stdOut;
        $this->hasStdOut    = $hasStdOut;
        $this->stdErr       = $stdErr;
        $this->hasStdErr    = $hasStdErr;
        $this->returnCode   = (int)$returnCode;
    }

    /**
     * Destructor closes the result and the internal stream resources
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Returns the reference to the call that resulted in this result
     *
     * @return Call
     */
    public function getCliCall()
    {
        return $this->cliCall;
    }

    /**
     * Returns the stdout stream
     *
     * @return resource
     */
    public function getStdOutStream()
    {
        return $this->stdOut;
    }

    /**
     * Returns the contents of stdout
     *
     * @return string
     */
    public function getStdOut()
    {
        fseek($this->stdOut, 0, SEEK_SET);
        return rtrim(stream_get_contents($this->stdOut));
    }

    /**
     * Returns true if the call resulted in stdout to be populated
     *
     * @return  boolean
     */
    public function hasStdOut()
    {
        return $this->hasStdOut;
    }

    /**
     * Returns the stderr stream
     *
     * @return resource
     */
    public function getStdErrStream()
    {
        return $this->stdErr;
    }

    /**
     * Returns the contents of stderr
     *
     * @return string
     */
    public function getStdErr()
    {
        fseek($this->stdErr, 0, SEEK_SET);
        return rtrim(stream_get_contents($this->stdErr));
    }

    /**
     * Returns true if the call resulted in stderr to be populated
     *
     * @return  boolean
     */
    public function hasStdErr()
    {
        return $this->hasStdErr;
    }

    /**
     * Returns the return code
     *
     * @return integer
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     * Closes the call result and the internal stream resources
     *
     * Prevents further usage
     */
    public function close()
    {
        if ($this->stdOut !== null) {
            fclose($this->stdOut);
            $this->stdOut   = null;
        }
        if ($this->stdErr !== null) {
            fclose($this->stdErr);
            $this->stdErr   = null;
        }
    }
}

?>