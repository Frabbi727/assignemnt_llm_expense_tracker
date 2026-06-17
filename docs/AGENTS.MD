# AGENTS.MD - Multi-Agent Framework Configuration

## 1. Operational Roles
* **Product Agent:** Verifies feature matches against instructions in `REQUIREMENT_SPEC.MD`.
* **Architect Agent:** Validates structural consistency based on `ARCHITECTURE.md`.
* **Developer Agent:** Code generation execution mapping directly to the rules in `CODING-GUIDELINES.md`.
* **QA Agent:** Structural code review and integration smoke checks.

## 2. Escalation Failover Protocol
1. **Loop Failure Rule:** If any agent hits a compiling block or data mutation fault, it handles an internal context self-correction logic loop up to 2 times.
2. **Model Escalation Trigger:** If an implementation step fails a 3rd consecutive time, Zen halts the script execution loop and switches the context tier up to an advanced model (Claude/Gemini Pro) to generate an error remediation patch.
